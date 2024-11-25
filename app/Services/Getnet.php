<?php 

namespace App\Services;

use App\Interfaces\PaymentGateway;
use App\Traits\Configurable;

class Getnet implements PaymentGateway
{
    use Configurable;

    protected $configuration_keys = ['getnet_client_id', 'getnet_client_secret'];

    public function generateCheckout($order)
    {
        
    }
}