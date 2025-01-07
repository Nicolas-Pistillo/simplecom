<?php

namespace App\Services\ShippingProviders;

use App\Interfaces\ShippingProvider;
use App\Traits\Configurable;
use App\Utils\ShippingRateParameters;
use Illuminate\Support\Collection;

class Mocis implements ShippingProvider
{
    use Configurable;

    protected $configuration_keys = ['mocis_api_client', 'mocis_api_secret'];

    public function getRates(ShippingRateParameters $parameters): Collection
    {
        return collect();
    }

    public function createOrder()
    {
        
    }
}