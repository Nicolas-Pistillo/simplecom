<?php

namespace App\Services\ShippingProviders;

use App\Enums\LogisticType;
use App\Interfaces\ShippingProvider;
use App\Models\Order;
use App\Models\OrderShipping;
use App\Services\CartService;
use App\Traits\Configurable;
use App\Utils\Address;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use App\Utils\ShippingBranch;
use Illuminate\Support\Facades\Storage;

class Mocis implements ShippingProvider
{
    use Configurable;

    protected $configuration_keys = ['mocis_api_client', 'mocis_api_secret'];

    private $base_url = 'https://mocis.akeron.net/api/v1';

    private $token;

    public function generateToken()
    {
        $response = Http::withBody(json_encode([
            'client_api'    => $this->key('mocis_api_client'),
            'client_secret' => $this->key('mocis_api_secret')
        ]))
        ->post("$this->base_url/auth/token")
        ->object();

        if (isset($response->status) && $response->status === true && !empty($response->result))
        {
            $this->token = data_get($response, 'result.0.api_token');
        }
    }

    public function getRates(ShippingRateParameters $parameters): Collection
    {
        $this->generateToken();

        $rates = collect();

        if (!$this->token) return $rates;

        $cartPackage = CartService::getPackageInfo();

        $weight = data_get($cartPackage, 'dimensions.weight');
        $height = data_get($cartPackage, 'dimensions.height');
        $length = data_get($cartPackage, 'dimensions.length');
        $width = data_get($cartPackage, 'dimensions.width');

        $results = Http::withToken($this->token)
                        ->withBody(json_encode([
                            'postal_code' => $parameters->recipient_address->zipcode,
                            'items'       => "[\"$weight,$height,$length,$width\"]"
                        ]))
                        ->post("$this->base_url/shipping/price")
                        ->collect('result');

        if ($results->isEmpty() || !$results->first()) return $rates;

        foreach($results as $result)
        {
            $serviceName = ucfirst(strtolower(trim(data_get($result, 'service.name'))));

            if (empty($serviceName) || $serviceName == '')
            {
                $serviceName = 'Envío a domicilio';
            }

            $fromDays = now()->diffInDays(Carbon::parse(data_get($result, 'min_delivery')));
            $toDays = now()->diffInDays(Carbon::parse(data_get($result, 'max_delivery')));

            $estimate = "$fromDays-$toDays días";

            if ($serviceName === 'Same day' || ($fromDays === 0 && $toDays === 1))
            {
                $estimate = 'Entre hoy y mañana';
            }

            if ($serviceName === 'Next day' || ($fromDays === 1 && $toDays === 2))
            {
                $estimate = 'Entre mañana y pasado';
            }

            $rate = new ShippingRate([
                'source'              => 'mocis',
                'source_name'         => "Mocis",
                'source_data'         => $result,
                'source_observations' => data_get($result, 'description'),
                'label'               => "Mocis - $serviceName",
                'carrier_logo'        => Storage::url('providers/mocis_icon.png'),
                'service_id'          => data_get($result, 'service.id'),
                'service_name'        => $serviceName,
                'logistic_type'       => LogisticType::OriginToDoor,
                'price'               => data_get($result, 'price_iva'),
                'estimate'            => $estimate
            ]);

            if (data_get($result, 'service.type') === 'pickup' && 
            !empty(data_get($result, 'pickup')) && !empty(data_get($result, 'address')))
            {
                $rate->logistic_type = LogisticType::OriginToDropoff;

                $branchAddress = new Address([
                    'street'   => data_get($result, 'address.address'),
                    'number'   => data_get($result, 'address.number'),
                    'zipcode'  => data_get($result, 'address.zipcode'),
                    'locality' => data_get($result, 'address.locality') ?? data_get($result, 'address.city'),
                    'state'    => data_get($result, 'address.province'),
                    'coordinates' => [
                        'lat' => data_get($result, 'address.latitude'),
                        'lng' => data_get($result, 'address.longitude')
                    ] 
                ]);

                $rate->branches->push(new ShippingBranch([
                    'source'      => 'mocis',
                    'source_name' => "Mocis",
                    'price'       => data_get($result, 'price_iva'),
                    'external_id' => data_get($result, 'pickup.id'),
                    'name'        => data_get($result, 'pickup.name'),
                    'phone'       => data_get($result, 'address.phone'),
                    'address'     => $branchAddress
                ]));
            }

            $rates->push($rate);
        }

        return $rates;
    }

    public function createOrder(Order $order)
    {
        
    }

    public function getStatus(OrderShipping $shipping)
    {
        
    }
}