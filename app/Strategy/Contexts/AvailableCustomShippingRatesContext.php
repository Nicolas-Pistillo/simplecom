<?php

namespace App\Strategy\Contexts;

use App\Enums\ShippingZoneType;
use App\Models\CustomShippingMethod;
use App\Strategy\Contracts\CustomShippingRateStrategy;
use App\Strategy\Strategies\CustomShippingEvaluationByCountryStrategy;
use App\Utils\ShippingRateParameters;
use Illuminate\Support\Collection;

class AvailableCustomShippingRatesContext
{
    protected ShippingRateParameters $rateParameters;
    protected CustomShippingRateStrategy $strategy;
    protected Collection $rates;

    public function __construct(ShippingRateParameters $rateParameters)
    {
        $this->rateParameters = $rateParameters;
    }

    public function setStrategy(CustomShippingRateStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function runStrategy(CustomShippingMethod $method): bool
    {
        return $this->strategy->evaluate($method, $this->rateParameters);
    }

    public function execute(): Collection
    {
        $rates = collect();

        $enabledShippingMethods = CustomShippingMethod::active()->get();

        if ($enabledShippingMethods->isNotEmpty()) 
        {
            foreach($enabledShippingMethods as $method)
            {
                if ($method->shipping_zone_type === ShippingZoneType::CountryAll)
                {
                    $this->setStrategy(new CustomShippingEvaluationByCountryStrategy);
                }

                $isAvailable = $this->runStrategy($method);

                if ($isAvailable) $rates->push($method);
            }
        }

        return $rates;
    }
}