<?php 

namespace App\Services\PaymentProviders;

use App\Interfaces\PaymentGateway;
use App\Traits\Configurable;
use App\Traits\ManagesPaymentRedirections;

class Openpay implements PaymentGateway
{
    use Configurable, ManagesPaymentRedirections;

    protected $configuration_keys = ['openpay_client_id', 'openpay_client_secret'];

    private $token;

    public function generateCheckout($order)
    {
        
    }
}