<?php

namespace App\Services\ShippingProviders;

use App\Enums\LogisticType;
use App\Enums\OrderFeedEvent;
use App\Enums\NotificationPresentation;
use App\Enums\OrderStatus;
use App\Enums\ShippingStatus;
use App\Interfaces\ShippingProvider;
use App\Models\Order;
use App\Models\OrderShipping;
use App\Services\CartService;
use App\Services\OrderService;
use App\Traits\Configurable;
use App\Utils\Address;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use App\Utils\ShippingBranch;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

        $cartPackage = CartService::getPackageInfo();

        $weight = data_get($cartPackage, 'weight');
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
                'service_code'        => data_get($result, 'service.id'),
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
        $this->generateToken();

        $destiny = $order->shipping->userAddress;

        $package = OrderService::calculatePackage($order);

        $weight = data_get($package, 'weight');
        $height = data_get($package, 'dimensions.height');
        $length = data_get($package, 'dimensions.length');
        $width = data_get($package, 'dimensions.width');

        $reference = tenant('name') . '|' . $order->shipping->id;

        $body = [
            'service'            => $order->shipping->provider_service_code,
            'delivery_pickup_id' => $order->shipping->selected_branch_id,
            'receives'           => $order->user->full_name,
            'address'            => "$destiny->street $destiny->number",
            'location'           => $destiny->locality,
            'reference'          => $destiny->references,
            'postal_code'        => $destiny->zipcode,
            'items'              => "[\"$weight,$height,$length,$width\"]",
            'lat'                => $destiny->lat,
            'lng'                => $destiny->lng,
            'telephone'          => $order->user->phone,
            'email'              => $order->user->email,
            'valor_declarado'    => data_get($package, 'declared_value'),
            'external_reference' => $reference,
            'bultos'             => 1
        ];

        $response = Http::withToken($this->token)
                        ->withBody(json_encode($body))
                        ->post("$this->base_url/shipping/new")
                        ->json();

        if (!$response || !isset($response['result'])) 
            throw new Exception('Error al crear envío con Mocis, intente de nuevo más tarde');

        if ($response && isset($response['status']) && !$response['status'])
            throw new Exception(data_get($response, 'msg'));

        $order->shipping->update([
            'status'             => ShippingStatus::ProviderProcessing,
            'external_status'    => 'En espera',
            'external_id'        => data_get($response, 'result.0'),
            'external_reference' => $reference, 
            'label_url'          => route('admin.shipping-label.mocis', $order->shipping->id)
        ]);

        $order->feed()->create([
            'event'         => OrderFeedEvent::ShippingUpdate,
            'presentation'  => NotificationPresentation::Icon,
            'initializator' => Auth::user()->name,
            'action'        => "generó la orden de envío con Moci's",
            'meta'          => [
                'icon_code' => 'local_shipping'
            ]
        ]);
    }

    public function getStatus(OrderShipping $shipping)
    {
        $this->generateToken();

        return Http::withToken($this->token)
                    ->get("$this->base_url/shipping/state/$shipping->external_id")
                    ->json();
    }

    public function syncStatus(OrderShipping $shipping)
    {
        /* "result" => array:1 [
            0 => array:13 [
            0 => array:2 [
                "id" => 0
                "name" => "En Espera"
            ]
            1 => array:2 [
                "id" => 9
                "name" => "Colectado"
            ]
            2 => array:2 [
                "id" => 4
                "name" => "En Deposito"
            ]
            3 => array:2 [
                "id" => 6
                "name" => "En Transito"
            ]
            4 => array:2 [
                "id" => 1
                "name" => "En Camino"
            ]
            5 => array:2 [
                "id" => 2
                "name" => "Entregado"
            ]
            6 => array:2 [
                "id" => -1
                "name" => "No Entregado"
            ]
            7 => array:2 [
                "id" => 5
                "name" => "Cancelado"
            ]
            8 => array:2 [
                "id" => 14
                "name" => "En proceso devolucion"
            ]
            9 => array:2 [
                "id" => 13
                "name" => "Devuelto"
            ]
            10 => array:2 [
                "id" => 10
                "name" => "Pendiente de retiro"
            ]
            11 => array:2 [
                "id" => 11
                "name" => "Retirado"
            ]
            12 => array:2 [
                "id" => 12
                "name" => "Retiro Fallido"
            ]
            ] */

        $statusResponse = $this->getStatus($shipping);

        if (!$statusResponse || !isset($statusResponse['status']) || !$statusResponse['status'])
            return false; // Or exception

        $currentStatusId = data_get($statusResponse, 'result.0.state_id');
        $currentStatusName = data_get($statusResponse, 'result.0.state');

        if ($currentStatusId === 0 && $shipping->status != ShippingStatus::ProviderPending)
        {
            $shipping->update([
                'status'          => ShippingStatus::ProviderProcessing,
                'external_status' => $currentStatusName
            ]);
        }

        if ($currentStatusId === 9 && $shipping->status != ShippingStatus::Dispatched)
        {
            $shipping->update([
                'status'             => ShippingStatus::Dispatched,
                'external_status'    => $currentStatusName
            ]);

            $shipping->order->update(['status' => OrderStatus::Dispatched]);

            $shipping->order->feed()->create([
                'event'         => OrderFeedEvent::ShippingUpdate,
                'presentation'  => NotificationPresentation::Image,
                'initializator' => "Moci's",
                'action'        => "colectó el pedido y lo preparará para su entrega",
                'meta'          => [
                    'img_src' => Storage::url('providers/mocis_icon.png')
                ]
            ]);
        }

        if (in_array($currentStatusId, [4, 6, 1]) && $shipping->status != ShippingStatus::InTransit)
        {
            $shipping->update([
                'status'             => ShippingStatus::InTransit,
                'external_status'    => $currentStatusName
            ]);

            $shipping->order->update(['status' => OrderStatus::InTransit]);

            $shipping->order->feed()->create([
                'event'         => OrderFeedEvent::ShippingUpdate,
                'presentation'  => NotificationPresentation::Image,
                'initializator' => "Moci's",
                'action'        => "ya está en camino a entregar el pedido",
                'meta'          => [
                    'img_src' => Storage::url('providers/mocis_icon.png')
                ]
            ]);
        }

        if ($currentStatusId === 5 && $shipping->status != ShippingStatus::Cancelled)
        {
            $shipping->update([
                'status'          => ShippingStatus::Cancelled,
                'external_status' => $currentStatusName
            ]);

            $shipping->order->feed()->create([
                'event'         => OrderFeedEvent::ShippingUpdate,
                'presentation'  => NotificationPresentation::Image,
                'initializator' => "Moci's",
                'action'        => "confirmó la cancelación del envío",
                'meta'          => [
                    'img_src' => Storage::url('providers/mocis_icon.png')
                ]
            ]);
        }

        if ($currentStatusId === 2 && $shipping->status != ShippingStatus::Delivered)
        {
            $shipping->update([
                'status'          => ShippingStatus::Delivered,
                'external_status' => $currentStatusName
            ]);

            $shipping->order->update(['status' => OrderStatus::Delivered]);

            $shipping->order->feed()->create([
                'event'         => OrderFeedEvent::ShippingUpdate,
                'presentation'  => NotificationPresentation::Icon,
                'initializator' => "Moci's",
                'action'        => "entregó el pedido",
                'meta'          => [
                    'icon_code'  => 'done',
                    'icon_color' => 'green'
                ]
            ]);
        }

        if ($currentStatusId === 13 && $shipping->status != ShippingStatus::Returned)
        {
            $shipping->update([
                'status'          => ShippingStatus::Returned,
                'external_status' => $currentStatusName
            ]);

            $shipping->order->feed()->create([
                'event'         => OrderFeedEvent::ShippingUpdate,
                'presentation'  => NotificationPresentation::Image,
                'initializator' => "Moci's",
                'action'        => "devolvió el pedido",
                'meta'          => [
                    'img_src' => Storage::url('providers/mocis_icon.png')
                ]
            ]);
        }

        $shipping->refresh();

        if ($currentStatusName != $shipping->external_status)
        {
            $shipping->update(['external_status' => $currentStatusName]);
        }
    }

    public function getLabelUrl(OrderShipping $shipping)
    {
        $this->generateToken();

        $response = Http::withToken($this->token)
                        ->throw()
                        ->get("$this->base_url/shipping/print/label/$shipping->external_id")
                        ->json();

        if (!isset($response['status']) || (isset($response['status']) && !$response['status']))
            throw new Exception('La respuesta del servicio no incluyó la etiqueta para descargar');

        return 'https://mocis.akeron.net/api' . data_get($response, 'result.0.pdf');
    }
}