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

class Saires implements ShippingProvider
{
    use Configurable;

    protected $configuration_keys = ['saires_client_id', 'saires_email'];

    private $api_key;

    public function generateApiKey()
    {
        $response = Http::withHeaders([
                        'Id-Cliente' => $this->key('saires_client_id'),
                        'Email'      => $this->key('saires_email')
                    ])
                    ->get("https://pre.sairesenvios.com.ar/api/v3/api-key")
                    ->object();

        if (isset($response->autorizado) && $response->autorizado && !empty($response->data))
        {
            $this->api_key = $response->data->api_key;
        }
    }

    public function getRates(ShippingRateParameters $parameters): Collection
    {
        $this->generateApiKey();

        $rates = collect();

        if (!$this->api_key) return $rates;

        $results = Http::withHeaders([
                        'Key'        => $this->api_key,
                        'Id-Cliente' => $this->key('saires_client_id')
                    ])
                    ->withBody(json_encode([
                        'codigo_postal' => $parameters->recipient_address->zipcode_number,
                        'pais'          => 'AR'
                    ]))
                    ->get('https://pre.sairesenvios.com.ar/api/v3/calcular-tarifas')
                    ->collect('data');

        if ($results->isEmpty()) return $rates;

        foreach($results as $result)
        {
            $serviceId = data_get($result, 'sigla_modalidad');

            if (in_array($serviceId, ['SAMEDY','NEXTDY','STDAMB', 'STDARD']) 
            && !$rates->contains('service_id', $serviceId))
            {
                $fromDays = now()->diffInDays(Carbon::parse(data_get($result, 'min_fecha_entrega')));
                $toDays = now()->diffInDays(Carbon::parse(data_get($result, 'max_fecha_entrega')));

                $estimate = "$fromDays-$toDays días";

                if ($serviceId === 'SAMEDY') $estimate = 'Entre hoy y mañana';

                $rates->push(new ShippingRate([
                    'source'                => 'saires',
                    'source_name'           => 'Saires',
                    'source_data'           => $result,
                    'logistic_type'         => LogisticType::OriginToDoor,
                    'label'                 => data_get($result, 'nombre'),
                    'service_id'            => $serviceId,
                    'service_code'          => data_get($result, 'referencia'),
                    'service_name'          => data_get($result, 'nombre'),
                    'carrier_logo'          => URL::to('img/providers/saires_icon.png'),
                    'price'                 => data_get($result, 'precio_entrega_comerciante'),
                    'estimate'              => $estimate
                ]));
            }
        }

        return $rates;
    }

    public function createOrder()
    {
        
    }
}