<?php 

namespace App\Strategy\Strategies;

use App\Strategy\Contracts\CustomShippingRateStrategy;

class CustomShippingEvaluationByLocalitiesStrategy implements CustomShippingRateStrategy
{
    public function evaluateZone(): mixed
    {
        return 1;
        // Implementation of the strategy to evaluate custom shipping rates by country
    }

    public function evaluateConditions(): mixed
    {
        return 1;
        // Implementation of the strategy to evaluate custom shipping conditions by country
    }
}