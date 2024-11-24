<?php 

namespace App\Services;

use App\Enums\PaymentRedirectType;
use App\Interfaces\PaymentGateway;
use App\Traits\Configurable;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

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
            'auto_return' => 'approved',
            'items' => [
                [
                    'title'      => 'Producto pruebita',
                    'quantity'   => 1,
                    'unit_price' => 3500
                ]
            ],
            'back_urls' => [
                'success' => route('payment.return', 'mercadopago'),
                'failure' => route('payment.return', 'mercadopago'),
                'pending' => route('payment.return', 'mercadopago'),
            ]
        ]);

        $this->provider_checkout_url = $preference->init_point;
    }
}