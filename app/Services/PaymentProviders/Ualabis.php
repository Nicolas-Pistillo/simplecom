<?php 

namespace App\Services\PaymentProviders;

use App\Interfaces\PaymentGateway;
use App\Traits\Configurable;
use App\Traits\ManagesPaymentRedirections;
use Uala\SDK as Uala;

class Ualabis implements PaymentGateway
{
    use Configurable, ManagesPaymentRedirections;

    protected $configuration_keys = ['ualabis_username', 'ualabis_client_id', 'ualabis_client_secret_id'];

    public function generateCheckout($order)
    {
        $user = tenant()->configValue('ualabis_username');
        $client_id = tenant()->configValue('ualabis_client_id');
        $client_secret = tenant()->configValue('ualabis_client_secret_id');

        $payment_return = route('payment.return', ['provider' => 'ualabis']); // Must be in HTTPs protocol
        
        $uala = new Uala($user, $client_id, $client_secret, true);

        $ualaOrder = $uala->createOrder(50, 'Order #1687', "https://google.com", "https://google.com");

        $retries = 1;

        while(!isset($ualaOrder->links) && $retries <= 5)
        {
            $ualaOrder = $uala->createOrder(50, 'Order #1687', "https://google.com", "https://google.com");
            $retries++;
        }

        $this->provider_checkout_url = $ualaOrder->links->checkoutLink;
    }
}