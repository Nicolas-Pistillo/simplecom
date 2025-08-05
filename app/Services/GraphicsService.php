<?php

namespace App\Services;

use App\Enums\CustomerType;
use App\Enums\PeriodOption;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class GraphicsService
{
    public static function getOrderEvolution(PeriodOption $period)
    {
        if ($period === PeriodOption::Historic) 
        {
            $orders = Order::paid()
                ->get()
                ->groupBy(function ($order) {
                    return $order->created_at->format('Y');
                })->map->sum('total');

            $sortedOrders = $orders->sortKeys();

            $chartData = [
                'labels' => $sortedOrders->keys()->toArray(),
                'data' => $sortedOrders->values()->toArray()
            ];

            return $chartData;
        }

        if ($period === PeriodOption::Today) 
        {
            $ordersByHour = Order::paid()
                ->whereDate('created_at', Carbon::today())
                ->get()
                ->groupBy(function ($order) {
                    return $order->created_at->format('H');
                })
                ->map->sum('total');

            $chartData = [
                'labels' => [],
                'data'   => []
            ];

            for ($hour = 0; $hour < 24; $hour++) {
                $formattedHour = sprintf("%02d:00", $hour);
                $chartData['labels'][] = $formattedHour;
                $chartData['data'][] = $ordersByHour->get($hour, 0);
            }

            return $chartData;
        }

        if ($period === PeriodOption::ThisWeek || $period === PeriodOption::LastWeek) 
        {
            $startOfWeek = $period === PeriodOption::ThisWeek
                ? Carbon::now()->startOfWeek()
                : Carbon::now()->subWeek()->startOfWeek();

            $endOfWeek = $period === PeriodOption::ThisWeek
                ? Carbon::now()->endOfWeek()
                : Carbon::now()->subWeek()->endOfWeek();

            $salesByDay = Order::paid()->selectRaw(
                "DAYNAME(created_at) as day_name, 
                DAYOFWEEK(created_at) as day_number,
                SUM(total) as total_sales"
            )
                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                ->groupBy('day_name', 'day_number')
                ->orderBy('day_number')
                ->get()
                ->mapWithKeys(function ($item) {
                    $daysInSpanish = [
                        'Monday' => 'Lunes',
                        'Tuesday' => 'Martes',
                        'Wednesday' => 'Miércoles',
                        'Thursday' => 'Jueves',
                        'Friday' => 'Viernes',
                        'Saturday' => 'Sábado',
                        'Sunday' => 'Domingo'
                    ];

                    return [$daysInSpanish[$item->day_name] ?? $item->day_name => $item->total_sales];
                });

            $allDays = [
                'Lunes'     => 0,
                'Martes'    => 0,
                'Miércoles' => 0,
                'Jueves'    => 0,
                'Viernes'   => 0,
                'Sábado'    => 0,
                'Domingo'   => 0
            ];

            $finalData = array_merge($allDays, $salesByDay->toArray());

            return [
                'labels' => array_keys($finalData),
                'data'   => array_values($finalData)
            ];
        }

        if ($period === PeriodOption::ThisMonth || $period === PeriodOption::LastMonth) 
        {
            $startOfMonth = $period === PeriodOption::ThisMonth
                ? Carbon::now()->startOfMonth()
                : Carbon::now()->subMonth()->startOfMonth();

            $endOfMonth = $period === PeriodOption::ThisMonth
                ? Carbon::now()->endOfMonth()
                : Carbon::now()->subMonth()->endOfMonth();

            $orders = Order::paid()
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->get()
                ->groupBy(fn ($order) =>  $order->created_at->format('Y-m-d'))
                ->map
                ->sum('total');

            $chartData = [
                'labels' => [],
                'data'   => []
            ];

            $current = $startOfMonth->copy();

            while ($current <= $endOfMonth) {
                $formattedDate = $current->format('Y-m-d');
                $chartData['labels'][] = $current->format('d M');
                $chartData['data'][] = $orders->get($formattedDate, 0);
                $current->addDay();
            }

            return $chartData;
        }
    }

    public static function getUserRegistration(PeriodOption $period)
    {
        if ($period === PeriodOption::Historic) 
        {
            $usersData = User::selectRaw('YEAR(created_at) as year, type, COUNT(*) as count')
                ->groupBy('year', 'type')
                ->orderBy('year')
                ->get();

            $groupedByYear = $usersData->groupBy('year');
            $years = $groupedByYear->keys()->sort()->values()->toArray();

            $registered = [];
            $guests = [];

            foreach ($years as $year) 
            {
                $yearData = $groupedByYear[$year] ?? collect();

                $registered[] = $yearData->where('type', CustomerType::Registered)->first()->count ?? 0;
                $guests[] = $yearData->where('type', CustomerType::Guest)->first()->count ?? 0;
            }

            // Estructura final para el gráfico
            $chartData = [
                'labels' => $years,
                'datasets' => [
                    [
                        'label' => 'Registrados',
                        'data' => $registered,
                        'borderColor' => getRawColor(tenant("color")),
                        'borderRadius' => 4,
                        'backgroundColor' => getRawColor(tenant("color")),
                    ],
                    [
                        'label' => 'Invitados',
                        'data' => $guests,
                        'borderColor' => '#cbcbcb',
                        'borderRadius' => 4,
                        'backgroundColor' => '#cbcbcb',
                    ]
                ]
            ];

            return $chartData;
        }

        if ($period === PeriodOption::Today) 
        {
            // Obtener conteo de usuarios por hora y tipo en una sola consulta
            $usersCount = User::whereDate('created_at', Carbon::today())
                ->selectRaw('HOUR(created_at) as hour, type, COUNT(*) as count')
                ->groupBy('hour', 'type')
                ->get()
                ->groupBy(['hour', 'type']);

            $chartData = [
                'labels' => [],
                'datasets' => [
                    [
                        'label' => 'Registrados',
                        'data' => array_fill(0, 24, 0),
                        'borderColor' => getRawColor(tenant("color")),
                        'borderRadius' => 4,
                        'backgroundColor' => getRawColor(tenant("color")),
                    ],
                    [
                        'label' => 'Invitados',
                        'data' => array_fill(0, 24, 0),
                        'borderColor' => '#cbcbcb',
                        'borderRadius' => 4,
                        'backgroundColor' => '#cbcbcb',
                    ]
                ]
            ];

            // Llenar las horas (00:00 a 23:00)
            for ($hour = 0; $hour < 24; $hour++) {
                $chartData['labels'][] = sprintf("%02d:00", $hour);
            }

            // Asignar los conteos reales
            foreach ($usersCount as $hour => $types) {
                foreach ($types as $type => $records) {
                    $index = $type === 'registered' ? 0 : 1;
                    $chartData['datasets'][$index]['data'][$hour] = $records->first()->count;
                }
            }

            return $chartData;
        }

        if ($period === PeriodOption::ThisWeek || $period === PeriodOption::LastWeek) 
        {
            // Determinar rango de fechas
            $startOfWeek = $period === PeriodOption::ThisWeek
                ? Carbon::now()->startOfWeek()
                : Carbon::now()->subWeek()->startOfWeek();

            $endOfWeek = $period === PeriodOption::ThisWeek
                ? Carbon::now()->endOfWeek()
                : Carbon::now()->subWeek()->endOfWeek();

            // Obtener datos de usuarios agrupados por día y tipo
            $usersByDay = User::selectRaw(
                "DAYNAME(created_at) as day_name, 
                DAYOFWEEK(created_at) as day_number,
                type,
                COUNT(*) as user_count"
            )
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->groupBy('day_name', 'day_number', 'type')
            ->orderBy('day_number')
            ->get();

            // Traducción de días al español
            $daysInSpanish = [
                'Monday' => 'Lunes',
                'Tuesday' => 'Martes',
                'Wednesday' => 'Miércoles',
                'Thursday' => 'Jueves',
                'Friday' => 'Viernes',
                'Saturday' => 'Sábado',
                'Sunday' => 'Domingo'
            ];

            // Estructura base para todos los días
            $allDays = [
                'Lunes' => ['registered' => 0, 'guest' => 0],
                'Martes' => ['registered' => 0, 'guest' => 0],
                'Miércoles' => ['registered' => 0, 'guest' => 0],
                'Jueves' => ['registered' => 0, 'guest' => 0],
                'Viernes' => ['registered' => 0, 'guest' => 0],
                'Sábado' => ['registered' => 0, 'guest' => 0],
                'Domingo' => ['registered' => 0, 'guest' => 0]
            ];

            // Procesar los resultados de la consulta
            foreach ($usersByDay as $record) {
                $dayName = $daysInSpanish[$record->day_name] ?? $record->day_name;
                $allDays[$dayName][$record->type->value] = $record->user_count;
            }

            // Preparar datos para el gráfico
            $chartData = [
                'labels' => array_keys($allDays),
                'datasets' => [
                    [
                        'label' => 'Registrados',
                        'data' => array_column($allDays, 'registered'),
                        'borderColor' => getRawColor(tenant('color')),
                        'borderRadius' => 4,
                        'backgroundColor' => getRawColor(tenant('color')),
                    ],
                    [
                        'label' => 'Invitados',
                        'data' => array_column($allDays, 'guest'),
                        'borderColor' => '#cbcbcb',
                        'borderRadius' => 4,
                        'backgroundColor' => '#cbcbcb',
                    ]
                ]
            ];

            return $chartData;
        }

        if ($period === PeriodOption::ThisMonth || $period === PeriodOption::LastMonth) 
        {
            $startOfMonth = $period === PeriodOption::ThisMonth
            ? Carbon::now()->startOfMonth()
            : Carbon::now()->subMonth()->startOfMonth();

            $endOfMonth = $period === PeriodOption::ThisMonth
                ? Carbon::now()->endOfMonth()
                : Carbon::now()->subMonth()->endOfMonth();

            // Obtenemos todos los usuarios creados en ese rango
            $users = User::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->get()
                ->groupBy(function ($user) {
                    return $user->created_at->format('Y-m-d');
                });

            $labels = [];
            $registeredData = [];
            $guestData = [];

            $current = $startOfMonth->copy();

            while ($current <= $endOfMonth) {
                $formattedDate = $current->format('Y-m-d');
                $labels[] = $current->format('d M');

                $usersOfDay = $users->get($formattedDate, collect());

                $registeredData[] = $usersOfDay->where('type', CustomerType::Registered)->count();
                $guestData[] = $usersOfDay->where('type', CustomerType::Guest)->count();

                $current->addDay();
            }

                $chartData = [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Registrados',
                        'data' => $registeredData,
                        'borderColor' => getRawColor(tenant('color')),
                        'borderRadius' => 4,
                        'backgroundColor' => getRawColor(tenant('color')),
                    ],
                    [
                        'label' => 'Invitados',
                        'data' => $guestData,
                        'borderColor' => '#cbcbcb',
                        'borderRadius' => 4,
                        'backgroundColor' => '#cbcbcb',
                    ]
                ]
            ];

            return $chartData;
        }
    }

    public static function getMostUsedPaymentMethods(PeriodOption $period)
    {
        if ($period === PeriodOption::Historic)
        {
            $ordersByHour = Order::with('paymentMethod')
                            ->paid()
                            ->get()
                            ->groupBy(function ($order) {
                                return $order->paymentMethod->display_name;
                            })
                            ->map->count();

            $chartData = [
                'labels' => [],
                'data'   => []
            ];

            foreach($ordersByHour as $method => $ordersCount)
            {
                $chartData['labels'][] = $method;
                $chartData['data'][] = $ordersCount;
            }

            return $chartData;
        }

        if ($period === PeriodOption::Today)
        {
            $ordersByHour = Order::with('paymentMethod')
                            ->paid()
                            ->whereDate('created_at', Carbon::today())
                            ->get()
                            ->groupBy(function ($order) {
                                return $order->paymentMethod->display_name;
                            })
                            ->map->count();

            $chartData = [
                'labels' => [],
                'data'   => []
            ];

            foreach($ordersByHour as $method => $ordersCount)
            {
                $chartData['labels'][] = $method;
                $chartData['data'][] = $ordersCount;
            }

            return $chartData;
        }

        if ($period === PeriodOption::ThisWeek || $period === PeriodOption::LastWeek)
        {
            $startOfWeek = $period === PeriodOption::ThisWeek
                ? Carbon::now()->startOfWeek()
                : Carbon::now()->subWeek()->startOfWeek();

            $endOfWeek = $period === PeriodOption::ThisWeek
                ? Carbon::now()->endOfWeek()
                : Carbon::now()->subWeek()->endOfWeek();

            $ordersByHour = Order::with('paymentMethod')
                            ->paid()
                            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                            ->get()
                            ->groupBy(function ($order) {
                                return $order->paymentMethod->display_name;
                            })
                            ->map->count();

            $chartData = [
                'labels' => [],
                'data'   => []
            ];

            foreach($ordersByHour as $method => $ordersCount)
            {
                $chartData['labels'][] = $method;
                $chartData['data'][] = $ordersCount;
            }

            return $chartData;
        }

        if ($period === PeriodOption::ThisMonth || $period === PeriodOption::LastMonth)
        {
            $startOfMonth = $period === PeriodOption::ThisMonth
                ? Carbon::now()->startOfMonth()
                : Carbon::now()->subMonth()->startOfMonth();

            $endOfMonth = $period === PeriodOption::ThisMonth
                ? Carbon::now()->endOfMonth()
                : Carbon::now()->subMonth()->endOfMonth();

            $ordersByHour = Order::with('paymentMethod')
                            ->paid()
                            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                            ->get()
                            ->groupBy(function ($order) {
                                return $order->paymentMethod->display_name;
                            })
                            ->map->count();

            $chartData = [
                'labels' => [],
                'data'   => []
            ];

            foreach($ordersByHour as $method => $ordersCount)
            {
                $chartData['labels'][] = $method;
                $chartData['data'][] = $ordersCount;
            }

            return $chartData;
        }
    }
}
