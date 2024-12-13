<?php 

namespace App\Services\ShippingProviders;

use App\Models\UserAddress;
use App\Traits\Configurable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class Zippin
{
    use Configurable;

    protected $configuration_keys = ['zippin_client_id', 'zippin_client_secret'];

    private $base_url = 'https://api.zippin.com.ar/v2';

    public function getRates(UserAddress $destination)
    {
        return Http::withBasicAuth(env('ZIPPIN_CLIENT_ID'), env('ZIPPIN_CLIENT_SEC'))
                    ->withBody(json_encode([
                        'account_id'     => 16082,
                        'origin_id'      => 357313,
                        'declared_value' => 285000,
                        'source'         => 'simplecom',
                        'destination' => [
                            'country' => 'AR',
                            'state'   => $destination->state,
                            'city'    => $destination->locality,
                            'zipcode' => $destination->zipcode
                        ],
                        'items' => [
                            [
                                "sku"         => "SMC-49877",
                                "description" => "Zapatillas Adidas",
                                "weight"      => 700,
                                "length"      => 24,
                                "height"      => 3,
                                "width"       => 12
                            ],
                            [
                                "sku"         => "SMC-49877",
                                "description" => "Zapatillas Adidas",
                                "weight"      => 700,
                                "length"      => 24,
                                "height"      => 3,
                                "width"       => 12
                            ],
                            [
                                "sku"         => "SMC-49877",
                                "description" => "Zapatillas Adidas",
                                "weight"      => 700,
                                "length"      => 24,
                                "height"      => 3,
                                "width"       => 12
                            ],
                            [
                                "sku"         => "SMC-49877",
                                "description" => "Zapatillas Adidas",
                                "weight"      => 2700,
                                "length"      => 24,
                                "height"      => 3,
                                "width"       => 12
                            ]
                        ]
                    ]))
                    ->post("$this->base_url/shipments/quote")
                    ->collect();
    }

    public function getAccounts()
    {
        return Http::withBasicAuth(env('ZIPPIN_CLIENT_ID'), env('ZIPPIN_CLIENT_SEC'))
                    ->get("$this->base_url/accounts")
                    ->json();
    }

    public function getOrigins()
    {
        return Http::withBasicAuth(env('ZIPPIN_CLIENT_ID'), env('ZIPPIN_CLIENT_SEC'))
                    ->get("$this->base_url/addresses")
                    ->json();
    }

    public function getWebhooks()
    {
        return Http::withBasicAuth(env('ZIPPIN_CLIENT_ID'), env('ZIPPIN_CLIENT_SEC'))
                    ->get("$this->base_url/accounts/16082/webhooks")
                    ->json();
    }
}