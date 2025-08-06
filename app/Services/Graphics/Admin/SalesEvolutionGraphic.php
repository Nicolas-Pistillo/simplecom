<?php

namespace App\Services\Graphics\Admin;

use App\Enums\PeriodOption;
use App\Models\Order;
use Carbon\Carbon;

class SalesEvolutionGraphic extends BaseGraphic
{
    public function generate()
    {
        if ($this->period === PeriodOption::Historic) 
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

        if ($this->period === PeriodOption::Today) 
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

        if ($this->period === PeriodOption::ThisWeek || $this->period === PeriodOption::LastWeek) 
        {
            $startOfWeek = $this->period === PeriodOption::ThisWeek
                ? Carbon::now()->startOfWeek()
                : Carbon::now()->subWeek()->startOfWeek();

            $endOfWeek = $this->period === PeriodOption::ThisWeek
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

        if ($this->period === PeriodOption::ThisMonth || $this->period === PeriodOption::LastMonth) 
        {
            $startOfMonth = $this->period === PeriodOption::ThisMonth
                ? Carbon::now()->startOfMonth()
                : Carbon::now()->subMonth()->startOfMonth();

            $endOfMonth = $this->period === PeriodOption::ThisMonth
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
}