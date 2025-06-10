<?php

namespace App\Enums;

use App\Models\Order;

enum PeriodOption: string
{
    case Historic   = 'historic';
    case Today      = 'today';
    case ThisWeek   = 'this_week';
    case ThisMonth  = 'this_month';
    case LastWeek   = 'last_week';
    case LastMonth  = 'last_month';

    public function name(): string
    {
        return match($this)
        {
            PeriodOption::Historic  => 'Histórico',
            PeriodOption::Today     => 'Hoy',
            PeriodOption::ThisWeek  => 'Esta semana',
            PeriodOption::ThisMonth => 'Este mes',
            PeriodOption::LastWeek  => 'Semana pasada',
            PeriodOption::LastMonth => 'Mes pasado',
        };
    }

    public function datesBetween(): null|array
    {
        return match($this)
        {
            PeriodOption::Historic  => [
                'from' => Order::first()->created_at,
                'to'   => Order::latest()->first()->created_at
            ],
            PeriodOption::Today     => [
                'from' => now()->startOfDay(),
                'to'   => now()
            ],
            PeriodOption::ThisWeek  => [
                'from' => now()->startOfWeek(),
                'to'   => now()
            ],
            PeriodOption::ThisMonth => [
                'from' => now()->startOfMonth(),
                'to'   => now()->endOfMonth()
            ],
            PeriodOption::LastWeek  => [
                'from' => now()->subWeek()->startOfWeek(),
                'to'   => now()->subWeek()->endOfWeek()
            ],
            PeriodOption::LastMonth => [
                'from' => now()->subMonth()->startOfMonth(),
                'to'   => now()->subMonth()->endOfMonth()
            ],
        };
    }
}