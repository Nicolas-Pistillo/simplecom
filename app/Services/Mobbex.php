<?php

namespace App\Services;

use App\Interfaces\PaymentGateway;
use App\Traits\Configurable;
use Exception;

class Mobbex implements PaymentGateway
{
    use Configurable;

    protected $configuration_keys = ['mobbex_api_key', 'mobbex_access_token'];

    public function generateCheckout($order)
    {
        
    }
}