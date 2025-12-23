<?php

namespace App\Services;

use App\Models\ShippingProvider;
use App\Utils\ShippingRateParameters;
use Illuminate\Support\Collection;
use App\Enums\LogisticType;
use App\Enums\ShippingZoneType;
use App\Models\CustomShippingMethod;
use App\Strategy\Contexts\AvailableCustomShippingRatesContext;
use App\Strategy\Strategies\CustomShippingEvaluationByCountryStrategy;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShippingRateService
{
    /**
     * Get all shipping rates (providers and customs) 
     * based on a App\Utils\ShippingRateParameters object
     */
    public static function getAvailableRates(ShippingRateParameters $rateParameters): Collection
    {
        $rates = collect();

        // Provider rates
        $providers = ShippingProvider::where('active', true)->get();

        foreach($providers as $provider)
        {
            $providerRates = $provider->service()->getRates($rateParameters);

            if ($providerRates->isNotEmpty()) $rates->push($providerRates);
        }

        $availableCustomShippingRates = (new AvailableCustomShippingRatesContext($rateParameters))->execute();

        if ($rates->isEmpty() && $availableCustomShippingRates->isEmpty()) return $rates;

        $rates = $rates->collapse();

        $shippingRates = $rates->whereIn('logistic_type', [
            LogisticType::DropoffToDoor, 
            LogisticType::OriginToDoor
        ])
        ->sortByDesc('price')
        ->take(3);

        // Add the custom shipping methods to "To-Door" shipping rates
        if ($availableCustomShippingRates->isNotEmpty())
        {
            $availableCustomShippingRates->map(fn($rate) => $rate->is_custom = true);
            $shippingRates = $shippingRates->merge($availableCustomShippingRates);
        }

        $dropoffRates = $rates->whereIn('logistic_type', [
            LogisticType::DropoffToDropoff, 
            LogisticType::OriginToDropoff
        ])
        ->sortByDesc('price');

        return collect([
            'shipping' => $shippingRates,
            'dropoff'  => $dropoffRates
        ]);
    }
}