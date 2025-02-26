<?php

namespace App\Services\ShippingProviders;

use App\Enums\LogisticType;
use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Enums\OrderStatus;
use App\Enums\ShippingStatus;
use App\Interfaces\ShippingProvider;
use App\Models\Order;
use App\Models\OrderShipping;
use App\Models\OriginPoint;
use App\Services\CartService;
use App\Services\OrderService;
use App\Traits\Configurable;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Rapiboy implements ShippingProvider
{
    use Configurable;

    protected $configuration_keys = ['rapiboy_api_token'];

    private $base_url;

    public function __construct()
    {
        $this->base_url = env('RAPIBOY_TEST') 
                        ? 'https://uat.rapiboy.com/v1' 
                        : 'https://rapiboy.com/v1';
    }

    public function getRates(ShippingRateParameters $parameters): Collection
    {
        $rates = collect();

        $cartPackage = CartService::getPackageInfo();

        $origin = OriginPoint::inUse();

        $response = Http::withHeader('Token', $this->key('rapiboy_api_token'))
                        ->withBody(json_encode([
                            'CPOrigen'  => $origin->zipcode_number,
                            'CPDestino' => $parameters->recipient_address->zipcode_number,
                            'Bultos'    => [
                                [
                                    'Largo'     => data_get($cartPackage, 'dimensions.length'),
                                    'Ancho'     => data_get($cartPackage, 'dimensions.width'),
                                    'Alto'      => data_get($cartPackage, 'dimensions.height'),
                                    'Peso'      => data_get($cartPackage, 'weight'),
                                    'Cantidad'  => 1
                                ]
                            ]
                        ]))
                        ->get("$this->base_url/NextDaySmart/Cotizar")
                        ->object();

        if (!isset($response->Resultado) || !$response->Resultado) return $rates;

        $rates->push(new ShippingRate([
            'source'              => 'rapiboy',
            'source_name'         => "Rapiboy",
            'source_data'         => $response,
            'label'               => "Rapiboy - Next Day",
            'carrier_logo'        => Storage::url('providers/rapiboy_icon.png'),
            'service_id'          => 'next_day_smart',
            'service_name'        => 'Next Day Smart',
            'logistic_type'       => LogisticType::OriginToDoor,
            'price'               => data_get($response, 'Precio'),
            'estimate'            => 'Entre mañana y pasado'
        ]));

        return $rates;
    }

    public function createOrder(Order $order)
    {
        $origin = OriginPoint::inUse();
        $destiny = $order->shipping->userAddress;

        if (!$origin) throw new Exception('No hay un punto de orígen en uso');

        $package = OrderService::calculatePackage($order);

        $body = [
            "DireccionOrigen"    => "$origin->street $origin->number",
            "CiudadOirgen"       => $origin->locality,
            "CPOrigen"           => $origin->zipcode_number,
            "NombreOrigen"       => "$origin->staff_name - " . tenant('ecommerce_name'),
            "ObservacionOrigen"  => $origin->references,
            "TelefonoOrigen"     => $origin->staff_phone,
            "LatitudOrigen"      => $origin->lat,
            "LongitudOrigen"     => $origin->lng,
            "DireccionDestino"   => "$destiny->street $destiny->number",
            "CiudadDestino"      => $destiny->locality,
            "CPDestino"          => $destiny->zipcode_number,
            "NombreDestino"      => $order->user->full_name,
            "ObservacionDestino" => $destiny->references,
            "TelefonoDestino"    => $order->user->phone,
            "EmailDestino"       => $order->user->email,
            "LatitudDestino"     => $destiny->lat,
            "LongitudDestino"    => $destiny->lng,
            "Piso"               => $destiny->floor,
            "Departamento"       => $destiny->apartment,
            "ReferenciaExterna"  => tenant('name') . '|' . $order->shipping->id,
            "Inversa"            => false,
            "Cambio"             => false,
            "Paquetes" => [
                [
                    "Largo"             => data_get($package, 'dimensions.length'),
                    "Ancho"             => data_get($package, 'dimensions.width'),
                    "Alto"              => data_get($package, 'dimensions.height'),
                    "Peso"              => data_get($package, 'weight'),
                    "AclaracionesBulto" => "Paquete",
                    "Cantidad"          => 1,
                    "ReferenciaExterna" => "Pedido $order->id"
                ]
            ]
        ];

        $response = Http::withHeader('Token', $this->key('rapiboy_api_token'))
                        ->withBody(json_encode($body))
                        ->post("$this->base_url/NextDaySmart/Post")
                        ->json();

        if (!$response && !isset($response['Message']))
            throw new Exception('Error al generar el envío con rapiboy, por favor intente de nuevo más tarde');

        if (isset($response['Message']))
            throw new Exception($response['Message']);

        $statusId = data_get($response, 'Estado');

        $order->shipping->update([
            'status'             => ShippingStatus::DispatchReady,
            'external_id'        => data_get($response, 'IdPedido'),
            'external_reference' => data_get($response, 'ReferenciaExterna'),
            'external_status_id' => $statusId,
            'external_status'    => "Procesando",
            'tracking_code'      => data_get($response, 'TrackingEncriptado'),
            'tracking_url'       => data_get($response, 'Link'),
            'label_url'          => data_get($response, 'Etiqueta')
        ]);

        $order->update(['status' => OrderStatus::DispatchReady]);

        $order->feed()->create([
            'event'         => OrderFeedEvent::ShippingUpdate,
            'presentation'  => OrderFeedPresentation::Icon,
            'initializator' => Auth::user()->name,
            'action'        => 'generó la orden de envío con Rapiboy',
            'meta'          => [
                'icon_code' => 'local_shipping'
            ]
        ]);
    }

    public function getStatus(OrderShipping $shipping)
    {
        return Http::withHeader('Token', $this->key('rapiboy_api_token'))
                        ->withBody(json_encode(['IdPedido' => $shipping->external_id]))
                        ->get("$this->base_url/NextDaySmart/Get")
                        ->json();
    }

    public function syncStatus(OrderShipping $shipping)
    {
        $statusResponse = $this->getStatus($shipping);

        if (isset($statusResponse['Resultado'], $statusResponse['Unico']))
        {
            $currentStatus = data_get($statusResponse, 'Unico.Estado');

            $currentStatus = 13;

            if (in_array($currentStatus, [14,20]) && $shipping->status != ShippingStatus::Cancelled)
            {
                $shipping->update([
                    'status'             => ShippingStatus::Cancelled,
                    'external_status_id' => $currentStatus,
                    'external_status'    => data_get($statusResponse, 'Unico.EstadoNombre')
                ]);

                $shipping->order->feed()->create([
                    'event'         => OrderFeedEvent::ShippingUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'Rapiboy',
                    'action'        => "confirmó la cancelación del envío",
                    'meta'          => [
                        'icon_code'  => 'local_shipping',
                        'icon_color' => 'red'
                    ]
                ]);
            }

            if ($currentStatus === 30 && $shipping->status != ShippingStatus::Sinister)
            {
                $shipping->update([
                    'status'             => ShippingStatus::Sinister,
                    'external_status_id' => $currentStatus,
                    'external_status'    => data_get($statusResponse, 'Unico.EstadoNombre')
                ]);

                $shipping->order->feed()->create([
                    'event'         => OrderFeedEvent::ShippingUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'Rapiboy',
                    'action'        => "reportó un siniestro durante el viaje, contactate urgentemente",
                    'meta'          => [
                        'icon_code'  => 'error',
                        'icon_color' => 'red'
                    ]
                ]);
            }

            if ($currentStatus === 32 && $shipping->status != ShippingStatus::Returned)
            {
                $shipping->update([
                    'status'             => ShippingStatus::Returned,
                    'external_status_id' => $currentStatus,
                    'external_status'    => data_get($statusResponse, 'Unico.EstadoNombre')
                ]);

                $shipping->order->feed()->create([
                    'event'         => OrderFeedEvent::ShippingUpdate,
                    'presentation'  => OrderFeedPresentation::Image,
                    'initializator' => 'Rapiboy',
                    'action'        => "devolvió el pedido",
                    'meta'          => [
                        'img_src' => Storage::url('providers/rapiboy_icon.png'),
                    ]
                ]);
            }

            if (in_array($currentStatus, [24,28,25,17]) && $shipping->status != ShippingStatus::InTransit)
            {
                $shipping->update([
                    'status'             => ShippingStatus::InTransit,
                    'external_status_id' => $currentStatus,
                    'external_status'    => data_get($statusResponse, 'Unico.EstadoNombre')
                ]);

                $shipping->order->update(['status' => OrderStatus::InTransit]);

                $shipping->order->feed()->create([
                    'event'         => OrderFeedEvent::ShippingUpdate,
                    'presentation'  => OrderFeedPresentation::Image,
                    'initializator' => 'Rapiboy',
                    'action'        => "colectó el pedido y ya está en viaje",
                    'meta'          => [
                        'img_src'   => Storage::url('providers/rapiboy_icon.png'),
                    ]
                ]);
            }

            if ($currentStatus === 29 && $shipping->status != ShippingStatus::DeliveryNear)
            {
                $shipping->update([
                    'status'             => ShippingStatus::DeliveryNear,
                    'external_status_id' => $currentStatus,
                    'external_status'    => data_get($statusResponse, 'Unico.EstadoNombre')
                ]);

                $shipping->order->feed()->create([
                    'event'         => OrderFeedEvent::ShippingUpdate,
                    'presentation'  => OrderFeedPresentation::Image,
                    'initializator' => 'Rapiboy',
                    'action'        => "está cerca del domicilio del cliente",
                    'meta'          => [
                        'img_src'   => Storage::url('providers/rapiboy_icon.png'),
                    ]
                ]);
            }

            if ($currentStatus === 13 && $shipping->status != ShippingStatus::Delivered)
            {
                $shipping->update([
                    'status'             => ShippingStatus::Delivered,
                    'external_status_id' => $currentStatus,
                    'external_status'    => data_get($statusResponse, 'Unico.EstadoNombre')
                ]);

                $shipping->order->update(['status' => OrderStatus::Delivered]);

                $shipping->order->feed()->create([
                    'event'         => OrderFeedEvent::ShippingUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'Rapiboy',
                    'action'        => "entregó el pedido correctamente",
                    'meta'          => [
                        'icon_code'  => 'done',
                        'icon_color' => 'green',
                    ]
                ]);
            }

            $shipping->refresh();

            if ($currentStatus != $shipping->external_status_id)
            {
                $shipping->update([
                    'external_status_id' => $currentStatus,
                    'external_status'    => data_get($statusResponse, 'Unico.EstadoNombre')
                ]);
            }
        }
    }
}