<?php

namespace App\Services\ShippingProviders;

use App\Enums\LogisticType;
use App\Enums\NotificationPresentation;
use App\Enums\OrderFeedEvent;
use App\Enums\ShippingStatus;
use App\Interfaces\ShippingProvider;
use App\Models\Order;
use App\Models\OrderShipping;
use App\Traits\Configurable;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class Saires implements ShippingProvider
{
    use Configurable;

    protected $configuration_keys = ['saires_client_id', 'saires_email'];

    private $api_key, $base_url;

    public function __construct()
    {
        $this->base_url = env('SAIRES_TEST') ? 'https://pre.sairesenvios.com.ar/api/v3'
                                             : 'https://www.sairesenvios.com.ar/api/v3';
    }

    public function generateApiKey()
    {
        $response = Http::withHeaders([
                        'Id-Cliente' => $this->key('saires_client_id'),
                        'Email'      => $this->key('saires_email')
                    ])
                    ->get("$this->base_url/api-key")
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
                    ->get("$this->base_url/calcular-tarifas")
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

                if ($fromDays == 0) $fromDays = 'Hoy';

                $estimate = "$fromDays-$toDays días";

                if ($serviceId === 'SAMEDY') $estimate = 'Entre hoy y mañana';

                $rates->push(new ShippingRate([
                    'source'                => 'saires',
                    'source_name'           => 'Saires',
                    'source_data'           => $result,
                    'logistic_type'         => LogisticType::OriginToDoor,
                    'label'                 => data_get($result, 'nombre'),
                    'service_id'            => $serviceId,
                    'service_code'          => $serviceId,
                    'service_name'          => data_get($result, 'nombre'),
                    'carrier_logo'          => Storage::url('providers/saires_icon.png'),
                    'price'                 => data_get($result, 'precio_entrega_comerciante'),
                    'estimate'              => $estimate
                ]));
            }
        }

        return $rates;
    }

    public function createOrder(Order $order)
    {
        $this->generateApiKey();

        if (!$this->api_key)
            throw new Exception('Saires rechazó las credenciales API');

        $destiny = $order->shipping->userAddress;

        $body = [
            'destinatario_nombre'   => $order->user->name,
            'destinatario_apellido' => $order->user->lastname,
            'destinatario_email'    => $order->user->email,
            'destinatario_telefono' => $order->user->phone,
            'tipo_paquete'          => 'PACECM',
            'siglas_pais'           => 'AR',
            'provincia'             => $destiny->state,
            'ciudad'                => $destiny->locality,
            'domicilio_entrega'     => "$destiny->street $destiny->number",
            'codigo_postal'         => $destiny->zipcode_number,
            'valor_declarado'       => $order->subtotal
        ];

        $response = Http::withHeaders([
            'Key'        => $this->api_key,
            'Id-Cliente' => $this->key('saires_client_id')
        ])
        ->withBody(json_encode($body))
        ->post("$this->base_url/crear-envio")
        ->json();

        if (!$response || !isset($response['data']) || !isset($response['data']['cui']))
            throw new Exception($response['mensaje']);

        $order->shipping->update([
            'external_id'     => data_get($response, 'data.cui'),
            'status'          => ShippingStatus::Created,
            'external_status' => 'Creado'
        ]);

        $order->feed()->create([
            'event'         => OrderFeedEvent::ShippingUpdate,
            'presentation'  => NotificationPresentation::Icon,
            'initializator' => Auth::user()->name,
            'action'        => 'generó la orden de envío con Saires',
            'meta'          => [
                'icon_code' => 'local_shipping'
            ]
        ]);
    }

    public function getStatus(OrderShipping $shipping)
    {
        $this->generateApiKey();

        return Http::withHeaders([
            'Key'        => $this->api_key,
            'Id-Cliente' => $this->key('saires_client_id')
        ])
        ->get("$this->base_url/$shipping->external_id/estado")
        ->json();
    }

    public function getCurrentPrice(OrderShipping $shipping)
    {
        $this->generateApiKey();

        return Http::withHeaders([
            'Key'        => $this->api_key,
            'Id-Cliente' => $this->key('saires_client_id')
        ])
        ->get("$this->base_url/$shipping->external_id/precio")
        ->json();
    }

    public function syncStatus(OrderShipping $shipping)
    {
        $statusResponse = $this->getStatus($shipping);

        dd($statusResponse);
    }
}