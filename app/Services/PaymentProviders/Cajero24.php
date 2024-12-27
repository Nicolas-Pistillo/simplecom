<?php 

namespace App\Services\PaymentProviders;

use App\Interfaces\PaymentGateway;
use App\Traits\Configurable;
use App\Traits\ManagesPaymentRedirections;

class Cajero24 implements PaymentGateway
{
    use Configurable, ManagesPaymentRedirections;

    protected $configuration_keys = ['cajero24_token'];

    public function generateCheckout($order)
    {
        
    }
}