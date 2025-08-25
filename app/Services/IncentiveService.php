<?php

namespace App\Services;

use App\Models\Incentive;

class IncentiveService
{
    public static function hasIncentives()
    {
        return Incentive::published()->count() > 0;
    }

    public static function get()
    {
        return Incentive::published()->get();
    }
}