<?php

namespace App\Services\ShippingProviders;

use App\Enums\LogisticType;
use App\Traits\Configurable;
use App\Utils\Address;
use App\Utils\ShippingBranch;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class Zippin
{
    use Configurable;

    protected $configuration_keys = ['zippin_account_id', 'zippin_key', 'zippin_secret', 'zippin_origin_id'];

    private $base_url = 'https://api.zippin.com.ar/v2';

    private $logistic_type_parser = [ // logistic_type field
        'pickup_point' => [
            'xd_dropoff'        => LogisticType::DropoffToDropoff,  // Alcance al centro de distribución
            'carrier_dropoff'   => LogisticType::DropoffToDropoff,  // Despacho en sucursal del transporte
            'carrier_pickup'    => LogisticType::OriginToDropoff,   // Recolección del transporte en el origen
            'crossdock'         => LogisticType::OriginToDropoff,   // Recolección unificada de Zippin en el origen
            'point_dropoff'     => LogisticType::DropoffToDropoff,  // Alcance a un punto de despacho propio de Zippin
            'self_service'      => LogisticType::OriginToDropoff    // Flota propia del vendedor
        ],
        'standard_delivery' => [
            'xd_dropoff'        => LogisticType::DropoffToDoor,  // Alcance al centro de distribución
            'carrier_dropoff'   => LogisticType::DropoffToDoor,  // Despacho en sucursal del transporte
            'carrier_pickup'    => LogisticType::OriginToDoor,   // Recolección del transporte en el origen
            'crossdock'         => LogisticType::OriginToDoor,   // Recolección unificada de Zippin en el origen
            'point_dropoff'     => LogisticType::DropoffToDoor,  // Alcance a un punto de despacho propio de Zippin
            'self_service'      => LogisticType::OriginToDoor    // Flota propia del vendedor
        ]
    ];

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
            'account_id'     => $this->key('zippin_account_id'),
            'origin_id'      => $this->key('zippin_origin_id'),
            'declared_value' => Cart::subtotal(),
            'source'         => 'simplecom',
            'items'          => $items,
            'destination' => [
                'country' => 'AR',
                'state'   => $parameters->recipient_address->state,
                'city'    => $parameters->recipient_address->locality,
                'zipcode' => $parameters->recipient_address->zipcode_number
            ]
        ];

        $response = $this->getRate($rateBody);

        if ($response->isEmpty()) return collect();

        $rates = collect();

        foreach ($response->get('results') as $result) 
        {
            $estimateDate = data_get($result, 'delivery_time.estimated_delivery');

            $dayDifference = now()->diffInDays($estimateDate);

            $estimate = in_array($dayDifference, [0, 1])
                            ? 'Entre hoy y mañana'
                            : "$dayDifference días";

            $serviceCode        = data_get($result, 'service_type.code');
            $sourceLogisticType = data_get($result, 'logistic_type');

            $logisticType = data_get($this->logistic_type_parser, "$serviceCode.$sourceLogisticType");

            $carrierName    = data_get($result, 'carrier.name');
            $carrierService = data_get($result, 'service_type.name');

            $shippingRate = new ShippingRate([
                'source'                => 'zippin',
                'source_name'           => 'Zippin',
                'source_data'           => $result,
                'label'                 => "$carrierName - $carrierService",
                'service_id'            => data_get($result, 'service_type.id'),
                'service_name'          => $carrierService,
                'service_code'          => $serviceCode,
                'logistic_type'         => $logisticType,
                'source_logistic_type'  => $sourceLogisticType,
                'carrier_id'            => data_get($result, 'carrier.id'),
                'carrier_name'          => $carrierName,
                'carrier_logo'          => data_get($result, 'carrier.logo'),
                'price'                 => data_get($result, 'amounts.price'),
                'estimate'              => $estimate
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

    public function getRate($rateBody)
    {
        return Http::withBasicAuth($this->key('zippin_key'), $this->key('zippin_secret'))
                    ->withBody(json_encode($rateBody))
                    ->post("$this->base_url/shipments/quote")
                    ->collect();
    }

    public function getAccounts()
    {
        return Http::withBasicAuth($this->key('zippin_key'), $this->key('zippin_secret'))
                    ->get("$this->base_url/accounts")
                    ->collect();
    }

    public function getOrigins()
    {
        return Http::withBasicAuth($this->key('zippin_key'), $this->key('zippin_secret'))
                    ->get("$this->base_url/addresses")
                    ->collect();
    }

    public function getWebhooks()
    {
        $account = $this->key('zippin_account_id');

        return Http::withBasicAuth($this->key('zippin_key'), $this->key('zippin_secret'))
                    ->get("$this->base_url/accounts/$account/webhooks")
                    ->collect();
    }
}
