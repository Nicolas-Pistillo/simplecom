<?php

namespace App\Services\Graphics\Admin;

use App\Enums\CustomerType;
use App\Enums\PeriodOption;
use App\Models\User;
use Carbon\Carbon;

class UserRegistrationGraphic extends BaseGraphic
{
    public function generate()
    {
        if ($this->period === PeriodOption::Historic) 
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

        if ($this->period === PeriodOption::Today) 
        {
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

            for ($hour = 0; $hour < 24; $hour++) {
                $chartData['labels'][] = sprintf("%02d:00", $hour);
            }

            foreach ($usersCount as $hour => $types) {
                foreach ($types as $type => $records) {
                    $index = $type === 'registered' ? 0 : 1;
                    $chartData['datasets'][$index]['data'][$hour] = $records->first()->count;
                }
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

            $daysInSpanish = [
                'Monday' => 'Lunes',
                'Tuesday' => 'Martes',
                'Wednesday' => 'Miércoles',
                'Thursday' => 'Jueves',
                'Friday' => 'Viernes',
                'Saturday' => 'Sábado',
                'Sunday' => 'Domingo'
            ];

            $allDays = [
                'Lunes' => ['registered' => 0, 'guest' => 0],
                'Martes' => ['registered' => 0, 'guest' => 0],
                'Miércoles' => ['registered' => 0, 'guest' => 0],
                'Jueves' => ['registered' => 0, 'guest' => 0],
                'Viernes' => ['registered' => 0, 'guest' => 0],
                'Sábado' => ['registered' => 0, 'guest' => 0],
                'Domingo' => ['registered' => 0, 'guest' => 0]
            ];

            foreach ($usersByDay as $record) {
                $dayName = $daysInSpanish[$record->day_name] ?? $record->day_name;
                $allDays[$dayName][$record->type->value] = $record->user_count;
            }

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

        if ($this->period === PeriodOption::ThisMonth || $this->period === PeriodOption::LastMonth) 
        {
            $startOfMonth = $this->period === PeriodOption::ThisMonth
            ? Carbon::now()->startOfMonth()
            : Carbon::now()->subMonth()->startOfMonth();

            $endOfMonth = $this->period === PeriodOption::ThisMonth
                ? Carbon::now()->endOfMonth()
                : Carbon::now()->subMonth()->endOfMonth();

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
}