<?php

namespace App\Services\PaymentProviders;

use App\Interfaces\PaymentGateway;
use App\Traits\Configurable;
use App\Traits\ManagesPaymentRedirections;
use Illuminate\Support\Facades\Http;

class Nave implements PaymentGateway
{
    use Configurable, ManagesPaymentRedirections;

    protected $configuration_keys = [
        'nave_client_id', 'nave_client_secret', 'nave_platform', 'nave_store_id'
    ];

    private $token;

    public function generateToken()
    {
        $client_id = tenant()->configValue('nave_client_id');
        $client_secret = tenant()->configValue('nave_client_secret');

        $response = Http::withBody(json_encode([
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'audience'      => 'https://naranja.com/ranty/merchants/api'
        ]))
        ->post('https://homoservices.apinaranja.com/security-ms/api/security/auth0/b2b/m2ms')
        ->json();

        $this->token = $response['access_token'];
    }

    public function generateCheckout($order)
    {
        $this->generateToken();

        $response = Http::withToken($this->token)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->withBody(json_encode([
                "platform"      => "platform-x",
                "store_id"      => "store1-platform-x",
                "callback_url"  => "https://platform_x.com.ar/callbacks",
                "order_id"      => "9546",
                "mobile"        => false,
                'payment_request' => [
                    'transactions' => [
                        [
                            'products' => [
                                [
                                    "id" => "883627",
                                    "name" => "Zapatillas Azules super Deportivas",
                                    "description" => "Una de las mejores zapatillas disponibles en el mercado",
                                    "quantity" => 2,
                                    "unit_price" => [
                                        "currency" => "ARS",
                                        "value"    => "76500"
                                    ]
                                ]
                            ],
                            'amount'   => [
                                "currency" => "ARS",
                                "value"    => "76500"
                            ]
                        ]
                    ],
                    'buyer' => [
                        "user_id"    => "nacho@naranjax.com",
                        "doc_type"   => "DNI",
                        "doc_number" => "N/A",
                        "user_email" => "nacho@naranjax.com",
                        "name"       => "N/A",
                        "phone"      => "N/A",
                        "billing_address" => [
                            "street_1"  => "Cliente",
                            "street_2"  => "N/A",
                            "city"      => "1",
                            "region"    => "Buenos Aires",
                            "country"   => "AR",
                            "zipcode"   => "5000"
                        ]
                    ]
                ]
            ]))
            ->throw()
            ->post('https://e3-api.ranty.io/ecommerce/payment_request/external')
            ->json();

        $this->provider_checkout_url = $response['data']['checkout_url'];
    }
}
