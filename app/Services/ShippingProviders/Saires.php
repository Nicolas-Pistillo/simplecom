<?php

namespace App\Services\ShippingProviders;

use App\Interfaces\ShippingProvider;
use App\Traits\Configurable;
use App\Utils\ShippingRateParameters;
use Illuminate\Support\Collection;

class Saires implements ShippingProvider
{
    use Configurable;

    protected $configuration_keys = ['saires_client_id', 'saires_email'];

    public function getRates(ShippingRateParameters $parameters): Collection
    {
        return collect();
    }

    public function createOrder()
    {
        
    }
}