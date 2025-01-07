<?php

namespace App\Services\ShippingProviders;

use App\Interfaces\ShippingProvider;
use App\Traits\Configurable;
use App\Utils\ShippingRateParameters;
use Illuminate\Support\Collection;

class Rapiboy implements ShippingProvider
{
    use Configurable;

    protected $configuration_keys = ['rapiboy_api_token'];

    public function getRates(ShippingRateParameters $parameters): Collection
    {
        return collect();
    }

    public function createOrder()
    {
        
    }
}