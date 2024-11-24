<?php 

namespace App\Services;

use App\Enums\PaymentRedirectType;
use App\Interfaces\PaymentGateway;
use App\Traits\Configurable;
use Uala\SDK as Uala;

class Ualabis implements PaymentGateway
{
    use Configurable;

    protected $configuration_keys = ['ualabis_username', 'ualabis_client_id', 'ualabis_client_secret_id'];

    public $redirect_type = PaymentRedirectType::ProviderPlatform;
    public $provider_checkout_url;

    public function generateCheckout($order)
    {
        $user = tenant()->configValue('ualabis_username');
        $client_id = tenant()->configValue('ualabis_client_id');
        $client_secret = tenant()->configValue('ualabis_client_secret_id');
        
        $uala = new Uala($user, $client_id, $client_secret, true);

        $ualaOrder = $uala->createOrder(15000, 'Order #1687', 'https://www.google.com', 'https://www.google.com');

        if (!isset($ualaOrder->links))
        {
            $ualaOrder = $uala->createOrder(15000, 'Order #1687', 'https://www.google.com', 'https://www.google.com');
        }

        if (!isset($ualaOrder->links))
        {
            $ualaOrder = $uala->createOrder(15000, 'Order #1687', 'https://www.google.com', 'https://www.google.com');
        }

        $this->provider_checkout_url = $ualaOrder->links->checkoutLink;
    }
}