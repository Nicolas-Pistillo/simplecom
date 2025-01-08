<?php

namespace App\Services\ShippingProviders;

use App\Enums\LogisticType;
use App\Interfaces\ShippingProvider;
use App\Traits\Configurable;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

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

        $results = Http::withToken($this->token)
                        ->withBody(json_encode([
                            'postal_code' => $parameters->recipient_address->zipcode
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

            $estimateDays = now()->diffInDays(Carbon::parse(data_get($result, 'max_delivery')));

            $estimate = "$estimateDays días";

            if ($serviceName === 'Same day')
            {
                $estimate = 'Entre hoy y mañana';
            }

            if ($serviceName === 'Next day')
            {
                $estimate = 'Entre mañana y pasado';
            }

            $rate = new ShippingRate([
                'source'              => 'mocis',
                'source_name'         => "Moci's",
                'source_data'         => $result,
                'source_observations' => data_get($result, 'description'),
                'label'               => "Moci's - $serviceName",
                'carrier_logo'        => URL::to('img/providers/mocis_icon.png'),
                'service_id'          => data_get($result, 'service.id'),
                'service_name'        => $serviceName,
                'logistic_type'       => LogisticType::OriginToDoor,
                'price'               => data_get($result, 'price_iva'),
                'estimate'            => $estimate
            ]);

            $rates->push($rate);
        }

        return $rates;
    }

    public function createOrder()
    {
        
    }
}