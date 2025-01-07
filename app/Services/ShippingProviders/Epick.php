<?php

namespace App\Services\ShippingProviders;

use App\Interfaces\ShippingProvider;
use App\Traits\Configurable;
use App\Utils\ShippingRateParameters;
use Illuminate\Support\Collection;

class Epick implements ShippingProvider
{
    use Configurable;

    protected $configuration_keys = ['epick_phone', 'epick_password'];

    public function getRates(ShippingRateParameters $parameters): Collection
    {
        return collect();
    }

    public function createOrder()
    {
        
    }
}