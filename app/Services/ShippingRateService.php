<?php

namespace App\Services;

use App\Models\ShippingProvider;
use App\Utils\ShippingRateParameters;
use Illuminate\Support\Collection;
use App\Enums\LogisticType;

class ShippingRateService
{
    public static function get(ShippingRateParameters $rateParameters): Collection
    {
        $rates = collect();

        $providers = ShippingProvider::where('active', true)->get();

        foreach($providers as $provider)
        {
            $providerRates = $provider->service()->getRates($rateParameters);
            if ($providerRates->isNotEmpty()) $rates->push($providerRates);
        }

        if ($rates->isEmpty()) return $rates;

        $rates = $rates->collapse();

        $shippingRates = $rates->whereIn('logistic_type', [
            LogisticType::DropoffToDoor, 
            LogisticType::OriginToDoor
        ]) 
        ->sortBy('price')
        ->take(3);

        $dropoffRates = $rates->whereIn('logistic_type', [
            LogisticType::DropoffToDropoff, 
            LogisticType::OriginToDropoff
        ])
        ->sortBy('price');

        return collect([
            'shipping' => $shippingRates,
            'dropoff'  => $dropoffRates
        ]);
    }
}