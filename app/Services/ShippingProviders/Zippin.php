<?php 

namespace App\Services\ShippingProviders;

use App\Models\UserAddress;
use App\Traits\Configurable;
use App\Utils\Address;
use App\Utils\ShippingBranch;
use App\Utils\ShippingRate;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class Zippin
{
    use Configurable;

    protected $configuration_keys = ['zippin_client_id', 'zippin_client_secret'];

    private $base_url = 'https://api.zippin.com.ar/v2';

    public function getRates(UserAddress $destination): Collection
    {
        $rates = collect();

        $response = Http::withBasicAuth(env('ZIPPIN_CLIENT_ID'), env('ZIPPIN_CLIENT_SEC'))
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

        if ($response->isEmpty()) return $rates;

        foreach($response->get('results') as $result)
        {
            $shippingRate = new ShippingRate([
                'source'        => 'zippin',
                'source_name'   => 'Zippin',
                'label'         => data_get($result, 'carrier.name') . ' - ' . data_get($result, 'service_type.name'),
                'source_data'   => $result,
                'service_id'    => data_get($result, 'service_type.id'),
                'service_name'  => data_get($result, 'service_type.name'),
                'service_code'  => data_get($result, 'service_type.code'),
                'dispatch_type' => $result['logistic_type'],
                'carrier_id'    => data_get($result, 'carrier.id'),
                'carrier_name'  => data_get($result, 'carrier.name'),
                'carrier_logo'  => data_get($result, 'carrier.logo'),
                'price'         => data_get($result, 'amounts.price'),
                'estimate'      => data_get($result, 'delivery_time.estimated_delivery')
            ]);

            if (isset($result['pickup_points']))
            {
                foreach($result['pickup_points'] as $pickup_point)
                {
                    $branchAddress = new Address([
                        'street'      => data_get($pickup_point, 'location.street'),
                        'number'      => data_get($pickup_point, 'location.street_number'),
                        'zipcode'     => data_get($pickup_point, 'location.zipcode'),
                        'locality'    => data_get($pickup_point, 'location.city'),
                        'state'       => data_get($pickup_point, 'location.state'),
                        'coordinates' => [
                            'lat' => data_get($pickup_point, 'location.geolocation.lat'),
                            'lng' => data_get($pickup_point, 'location.geolocation.lng')
                        ]
                    ]);

                    $branch = new ShippingBranch([
                        'source'        => 'zippin',
                        'source_name'   => 'Zippin',
                        'external_id'   => $pickup_point['point_id'],
                        'name'          => $pickup_point['description'],
                        'phone'         => $pickup_point['phone'],
                        'address'       => $branchAddress
                    ]);

                    $shippingRate->branches->push($branch);
                }
            }

            $rates->push($shippingRate);
        }

        return $rates;
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