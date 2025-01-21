<?php

namespace App\Services\PaymentProviders;

use App\Enums\PaymentRedirectType;
use App\Interfaces\PaymentGateway;
use App\Models\PaymentMethod;
use App\Traits\Configurable;
use Illuminate\Support\Facades\Http;

class Mobbex implements PaymentGateway
{
    use Configurable;

    protected $configuration_keys = ['mobbex_api_key', 'mobbex_access_token'];

    public $redirect_type = PaymentRedirectType::ProviderPlatform;
    public $provider_checkout_url;

    public function model(): PaymentMethod
    {
        return PaymentMethod::where('code', 'mobbex')->first();
    }

    public function generateCheckout($order)
    {
        $api_key = tenant()->configValue('mobbex_api_key');
        $access_token = tenant()->configValue('mobbex_access_token');

        $checkout = Http::withHeaders([
            'x-api-key'      => $api_key,
            'x-access-token' => $access_token,
            'content-type'   => 'application/json'
        ])->withBody(json_encode([
            'total'       => 25000,
            'description' => 'Pedido TEST',
            'reference'   => uniqid(),
            'currency'    => 'ARS',
            'test'        => true,
            'return_url'  => route('payment.return', ['provider' => 'mobbex']),
            'webhook'     => 'https://google.com',
            'customer'    => [
                'email' => 'pistillonicolas@gmail.com',
                'name'  => 'Nicolas Pistillo',
                'identification' => '42395031'
            ]
        ]))
        ->throw()
        ->post("https://api.mobbex.com/p/checkout")
        ->json();

        $this->provider_checkout_url = $checkout['data']['url'];
    }
}