<?php

namespace App\Services\ShippingProviders;

use App\Traits\Configurable;
use App\Utils\Address;
use App\Utils\ShippingBranch;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;

class Zippin
{
    use Configurable;

    protected $configuration_keys = ['zippin_account_id', 'zippin_key', 'zippin_secret', 'zippin_origin_id'];

    private $base_url = 'https://api.zippin.com.ar/v2';

    public function getRates(ShippingRateParameters $parameters): Collection
    {
        $items = Cart::content()->map(function ($item) 
        {
            return [
                'sku'         => strval($item->model->code ?? $item->model->id),
                'description' => $item->model->name,
                'weight'      => intval($item->model->weight),
                'width'       => intval($item->model->width),
                'height'      => intval($item->model->height),
                'length'      => intval($item->model->length)
            ];
        })->toArray();

        $rateBody = [
            'account_id'     => 16082,
            'origin_id'      => 357313,
            'declared_value' => 285000,
            'source'         => 'simplecom',
            'items'          => $items,
            'destination' => [
                'country' => 'AR',
                'state'   => $parameters->recipient_address->state,
                'city'    => $parameters->recipient_address->locality,
                'zipcode' => $parameters->recipient_address->zipcode_number
            ]
        ];

        $response = Http::withBasicAuth(env('ZIPPIN_CLIENT_ID'), env('ZIPPIN_CLIENT_SEC'))
                        ->withBody(json_encode($rateBody))
                        ->post("$this->base_url/shipments/quote")
                        ->collect();

        if ($response->isEmpty()) return collect();

        $rates = collect();

        foreach ($response->get('results') as $result) 
        {
            $estimateDate = data_get($result, 'delivery_time.estimated_delivery');

            $dayDifference = now()->diffInDays($estimateDate);

            $estimate = in_array($dayDifference, [0, 1])
                            ? 'Entre hoy y mañana'
                            : "$dayDifference días habiles";

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
                'estimate'      => $estimate
            ]);

            if (isset($result['pickup_points']))
            {
                foreach ($result['pickup_points'] as $pickup_point) 
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
                    ->collect();
    }

    public function getOrigins()
    {
        return Http::withBasicAuth(env('ZIPPIN_CLIENT_ID'), env('ZIPPIN_CLIENT_SEC'))
                    ->get("$this->base_url/addresses")
                    ->collect();
    }

    public function getWebhooks()
    {
        return Http::withBasicAuth(env('ZIPPIN_CLIENT_ID'), env('ZIPPIN_CLIENT_SEC'))
                    ->get("$this->base_url/accounts/16082/webhooks")
                    ->collect();
    }
}
