<?php

namespace App\Services\Graphics\Admin;

use App\Enums\PeriodOption;

abstract class BaseGraphic
{
    public function __construct(public PeriodOption $period) {}

    public function setPeriod(PeriodOption $period)
    {
        $this->period = $period;
    }
}
