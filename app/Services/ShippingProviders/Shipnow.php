<?php

namespace App\Services\ShippingProviders;

use App\Enums\LogisticType;
use App\Interfaces\ShippingProvider;
use App\Models\Order;
use App\Models\OrderShipping;
use App\Services\CartService;
use App\Traits\Configurable;
use App\Utils\Address;
use App\Utils\ShippingBranch;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class Shipnow implements ShippingProvider
{
    use Configurable;

    protected $configuration_keys = ['shipnow_api_token'];

    private $logistic_type_parser = [
        'ship_pas' => LogisticType::OriginToDropoff,
        'ship_sap' => LogisticType::DropoffToDoor,
        'ship_pap' => LogisticType::OriginToDoor,
        'ship_sas' => LogisticType::DropoffToDropoff
    ];

    public function getRates(ShippingRateParameters $parameters): Collection
    {
        $rates = collect();

        $packageInfo = CartService::getPackageInfo();

        $results = Http::withToken($this->key('shipnow_api_token'))
                        ->withQueryParameters([
                            'weight' => data_get($packageInfo, 'weight'),
                            'to_zip_code' => $parameters->recipient_address->zipcode_number,
                            'types'       => 'ship_pap,ship_pas,ship_sap,ship_sas'
                        ])
                        ->get('https://api.shipnow.com.ar/shipping_options')
                        ->collect('results');

        if (!$results || $results->isEmpty()) return $rates;

        foreach($results as $result)
        {
            $logisticType = data_get($this->logistic_type_parser, data_get($result, 'shipping_service.type'));

            $fromDays = now()->diffInDays(Carbon::parse(data_get($result, 'minimum_delivery')));
            $toDays = now()->diffInDays(Carbon::parse(data_get($result, 'maximum_delivery')));

            $estimate = "$fromDays-$toDays días";

            if ($fromDays === $toDays) $estimate = "$toDays días";
            if ($fromDays === 0 && $toDays === 1) $estimate = 'Entre hoy y mañana';
            if (($fromDays === 1 && $toDays === 2)) $estimate = 'Entre mañana y pasado';

            $rate = new ShippingRate([
                'source'                => 'shipnow',
                'source_name'           => 'Shipnow',
                'source_data'           => $result,
                'contract'              => data_get($result, 'shipping_contract.id'),
                'source_logistic_type'  => data_get($result, 'shipping_service.type'),
                'logistic_type'         => $logisticType,
                'label'                 => data_get($result, 'shipping_service.description'),
                'service_id'            => data_get($result, 'shipping_service.id'),
                'service_code'          => data_get($result, 'shipping_service.code'),
                'service_name'          => data_get($result, 'shipping_service.description'),
                'carrier_id'            => data_get($result, 'shipping_service.carrier.id'),
                'carrier_code'          => data_get($result, 'shipping_service.carrier.code'),
                'carrier_name'          => data_get($result, 'shipping_service.carrier.name'),
                'carrier_logo'          => data_get($result, 'shipping_service.carrier.image_url'),
                'price'                 => data_get($result, 'tax_price'),
                'estimate'              => $estimate
            ]);

            if ($rate->carrier_code === 'shipnow')
            {
                $rate->carrier_logo = Storage::url('providers/shipnow_icon.png');
            }

            if (data_get($result, 'ship_to_type') === 'PostOffice')
            {
                $branchAddress = new Address([
                    'street'      => data_get($result, 'ship_to.address.street_name'),
                    'number'      => data_get($result, 'ship_to.address.street_number'),
                    'zipcode'     => data_get($result, 'ship_to.address.zip_code'),
                    'locality'    => data_get($result, 'ship_to.address.city'),
                    'state'       => data_get($result, 'ship_to.address.state'),
                    'coordinates' => [
                        'lat' => data_get($result, 'ship_to.address.lat'),
                        'lng' => data_get($result, 'ship_to.address.lon')
                    ]
                ]);

                $branch = new ShippingBranch([
                    'source'        => 'shipnow',
                    'source_name'   => 'Shipnow',
                    'external_id'   => data_get($result, 'ship_to.id'),
                    'external_code' => data_get($result, 'ship_to.external_id'),
                    'external_type' => data_get($result, 'ship_to_type'),
                    'name'          => data_get($result, 'ship_to.description'),
                    'price'         => $rate->price,
                    'phone'         => data_get($result, 'ship_to.address.phone'),
                    'address'       => $branchAddress
                ]);

                $rate->branches->push($branch);
            }

            $rates->push($rate);
        }

        return $rates;
    }

    public function createOrder(?Order $order)
    {
        
    }

    public function getStatus(OrderShipping $shipping)
    {
        
    }
}