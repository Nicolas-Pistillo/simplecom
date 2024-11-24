<?php 

namespace App\Services;

use App\Enums\PaymentRedirectType;
use App\Interfaces\PaymentGateway;
use App\Traits\Configurable;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;

class MercadoPago implements PaymentGateway
{
    use Configurable;

    protected $configuration_keys = ['mp_access_token'];

    public $redirect_type = PaymentRedirectType::ProviderPlatform;
    public $provider_checkout_url;

    public function generateCheckout($order)
    {
        $access_token = tenant()->configValue('mp_access_token');

        MercadoPagoConfig::setAccessToken($access_token);

        $client = new PreferenceClient();

        $preference = $client->create([
            'items' => [[
                'title'      => 'Producto pruebita',
                'quantity'   => 1,
                'unit_price' => 3500
            ]
        ]]);

        $this->provider_checkout_url = $preference->init_point;
    }
}