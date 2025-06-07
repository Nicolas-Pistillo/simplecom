<?php

namespace App\Enums;

enum PeriodOption: string
{
    case Historic   = 'historic';
    case Today      = 'today';
    case ThisWeek   = 'this_week';
    case LastWeek   = 'last_week';
    case LastMonth  = 'last_month';

    public function name(): string
    {
        return match($this)
        {
            PeriodOption::Historic  => 'Histórico',
            PeriodOption::Today     => 'Hoy',
            PeriodOption::ThisWeek  => 'Esta semana',
            PeriodOption::LastWeek  => 'Semana pasada',
            PeriodOption::LastMonth => 'Mes pasado',
        };
    }
}