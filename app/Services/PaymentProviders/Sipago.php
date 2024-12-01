<?php 

namespace App\Services\PaymentProviders;

use App\Interfaces\PaymentGateway;
use App\Traits\Configurable;
use App\Traits\ManagesPaymentRedirections;
use Illuminate\Support\Facades\Http;

class Sipago implements PaymentGateway
{
    use Configurable, ManagesPaymentRedirections;

    protected $configuration_keys = ['sipago_client_id', 'sipago_client_secret'];

    private $token;

    public function generateToken()
    {
        $client_id = tenant()->configValue('sipago_client_id');
        $client_secret = tenant()->configValue('sipago_client_secret');

        $response = Http::withBody(json_encode([
            'grant_type'    => 'client_credentials',
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'scope'         => '*'
        ]))
        ->post('https://auth.preprod.geopagos.com/oauth/token')
        ->json();

        $this->token = $response['access_token'];
    }

    public function generateCheckout($order)
    {
        $this->generateToken();

        $response = Http::withToken($this->token)
                        ->withBody(json_encode([
                            'data' => [
                                'attributes' => [
                                    'currency' => "032",
                                    'items' => [
                                        [
                                            'id' => 1,
                                            'name' => 'Super product',
                                            'unitPrice' => [
                                                'currency' => '032',
                                                'amount'   => 110000
                                            ],
                                            'quantity' => 1
                                        ],
                                        [
                                            'id' => 1,
                                            'name' => 'Super product 2',
                                            'unitPrice' => [
                                                'currency' => '032',
                                                'amount'   => 170000
                                            ],
                                            'quantity' => 1
                                        ]
                                    ]
                                ]
                            ]
                        ]), 'application/vnd.api+json')
                        ->withHeaders([
                            'Content-Type' => 'application/vnd.api+json',
                            'Accept'       => 'application/vnd.api+json'
                        ])
                        ->throw()
                        ->post('https://api-cabal.preprod.geopagos.com/api/v2/orders')
                        ->json();

        $this->provider_checkout_url = $response['data']['links'][0]['checkout'];
    }
}