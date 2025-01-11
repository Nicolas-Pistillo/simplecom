<?php

namespace App\Services\ShippingProviders;

use App\Enums\LogisticType;
use App\Interfaces\ShippingProvider;
use App\Models\UserAddress;
use App\Services\CartService;
use App\Traits\Configurable;
use App\Utils\Address;
use App\Utils\ShippingBranch;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class Enviamelo implements ShippingProvider
{
    use Configurable;

    protected $configuration_keys = ['enviamelo_token'];

    public function getRates(ShippingRateParameters $parameters): Collection
    {
        $cartPackage = CartService::getPackageInfo('kg');

        $rates = collect();

        $results = Http::withToken($this->key('enviamelo_token'))
                        ->withBody(json_encode([
                            'weight'      => data_get($cartPackage, 'dimensions.weight'),
                            'postal_code' => $parameters->recipient_address->zipcode_number
                        ]))
                        ->post('https://api.enviamelo.com.ar/api/v1/price')
                        ->collect('data');

        if (!$results || $results->isEmpty()) return $rates;

        foreach($results as $result)
        {
            $isPickup = data_get($result, 'point');

            $service = data_get($result, 'term');

            $rate = new ShippingRate([
                'source'                => 'enviamelo',
                'source_name'           => 'Envíamelo',
                'source_data'           => $result,
                'logistic_type'         => LogisticType::OriginToDoor,
                'label'                 => "Envíamelo $service",
                'service_id'            => $service,
                'service_name'          => $service,
                'carrier_logo'          => Storage::url('providers/enviamelo_icon.png'),
                'price'                 => data_get($result, 'amount')
            ]);

            if ($isPickup)
            {
                $points = $this->getPickupPoints($parameters->recipient_address);

                if ($points->isNotEmpty())
                {
                    $rate->logistic_type = LogisticType::OriginToDropoff;
                    $rate->branches = $points;
                }
            }

            $rates->push($rate);
        }

        return $rates;
    }

    public function createOrder()
    {
        
    }

    public function getPickupPoints(UserAddress|Address $destination): Collection
    {
        $response = Http::withToken($this->key('enviamelo_token'))
                    ->withBody(json_encode([
                        'postal_code' => $destination->zipcode_number
                    ]))
                    ->post('https://api.enviamelo.com.ar/api/v1/points')
                    ->collect('data');

        if (!$response || $response->isEmpty()) return collect();

        $points = collect();

        foreach($response as $point)
        {
            $branchAddress = new Address([
                'street'      => data_get($point, 'street'),
                'number'      => data_get($point, 'height'),
                'zipcode'     => data_get($point, 'postal_code'),
                'locality'    => data_get($point, 'location.location'),
                'state'       => data_get($point, 'location.province.province'),
                'references'  => data_get($point, 'note'),
                'coordinates' => [
                    'lat' => data_get($point, 'latitude'),
                    'lng' => data_get($point, 'longitude')
                ]
            ]);

            $branch = new ShippingBranch([
                'source'      => 'enviamelo',
                'source_name' => 'Enviamelo',
                'external_id' => data_get($point, 'id'),
                'name'        => data_get($point, 'note'),
                'address'     => $branchAddress
            ]);

            $points->push($branch);
        }

        return $points;
    }
}