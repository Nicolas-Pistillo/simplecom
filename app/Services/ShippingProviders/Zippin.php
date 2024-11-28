<?php 

namespace App\Services\ShippingProviders;

use App\Traits\Configurable;
use Illuminate\Support\Facades\Http;

class Zippin
{
    use Configurable;

    protected $configuration_keys = ['zippin_client_id', 'zippin_client_secret'];

    private $base_url = 'https://api.zippin.com.ar/v2';

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

    public function getRates()
    {
        return Http::withBasicAuth(env('ZIPPIN_CLIENT_ID'), env('ZIPPIN_CLIENT_SEC'))
                ->withBody(json_encode([
                    'account_id'     => 16082,
                    'origin_id'      => 357313,
                    'declared_value' => 18500,
                    'destination' => [
                        'country' => 'AR',
                        'state'   => 'Buenos Aires',
                        'city'    => 'Avellaneda',
                        'zipcode' => "1868"
                    ],
                    'items' => [
                        [
                            "sku"         => "SMC-49877",
                            "description" => "Zapatillas Adidas",
                            "weight"      => 700,
                            "length"      => 24,
                            "height"      => 3,
                            "width"       => 12
                        ]
                    ]
                ]))
                ->post("$this->base_url/shipments/quote")
                ->json();
    }
}