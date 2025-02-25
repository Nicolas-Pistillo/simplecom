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
use App\Services\CartService;
use App\Traits\Configurable;
use App\Utils\Address;
use App\Utils\ShippingBranch;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Zippin implements ShippingProvider
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

        $response = Http::withBasicAuth($this->key('zippin_key'), $this->key('zippin_secret'))
                        ->withBody(json_encode($rateBody))
                        ->post("$this->base_url/shipments/quote")
                        ->collect();

        if (!$response || $response->isEmpty() || !$response->get('results')) return collect();

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
                'carrier_name'          => $carrierName,
                'carrier_code'          => data_get($result, 'carrier.id'),
                'carrier_logo'          => data_get($result, 'carrier.logo'),
                'price'                 => data_get($result, 'amounts.price_incl_tax'),
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

    public function createOrder(Order $order)
    {
        $sourceRate = data_get($order->shipping->calculated_rate, 'source_data');

        $items = [];

        foreach($order->items as $item)
        {
            array_push($items, [
                'sky'         => $item->product->code ?? $item->product->id,
                'description' => $item->name,
                'weight'      => intval($item->product->weight),
                'width'       => intval($item->product->width),
                'height'      => intval($item->product->height),
                'length'      => intval($item->product->length)
            ]);
        }

        $body = [
            'account_id'     => $this->key('zippin_account_id'),
            'origin_id'      => $this->key('zippin_origin_id'),
            'logistic_type'  => data_get($sourceRate, 'logistic_type'),
            'service_type'   => $order->shipping->provider_service_code,
            'carrier_id'     => intval($order->shipping->provider_carrier_code),
            'declared_value' => floatval($order->subtotal),
            'source'         => 'simplecom',
            'external_id'    => tenant('name') . '--' . $order->shipping->id,
            'items'          => $items,
            'destination' => [
                'name'          => $order->user->full_name,
                'email'         => $order->user->email,
                'phone'         => $order->user->phone,
                'document'      => $order->user->document,
                'country'       => 'AR',
                'street'        => $order->shipping->userAddress->street,
                'street_number' => $order->shipping->userAddress->number,
                'zipcode'       => $order->shipping->userAddress->zipcode_number,
                'city'          => $order->shipping->userAddress->locality,
                'state'         => $order->shipping->userAddress->state,
                'extras'        => $order->shipping->userAddress->references
            ]
        ];

        if ($order->shipping->logistic_type->isToDropoff())
        {
            $body['destination']['point_id'] = $order->shipping->selected_branch_id;
        }
        
        $response = Http::withBasicAuth($this->key('zippin_key'), $this->key('zippin_secret'))
                        ->withBody(json_encode($body))
                        ->post("$this->base_url/shipments")
                        ->throw()
                        ->json();

        if (!isset($response['id']))
            throw new Exception('Error al generar la orden de envío con Zippin');

        $order->shipping->update([
           'status'             => ShippingStatus::ProviderProcessing,
           'external_id'        => data_get($response, 'id'),
           'external_reference' => data_get($response, 'external_id'),
           'final_price'        => data_get($response, 'price_incl_tax'),
           'external_status'    => data_get($response, 'status_name'),
           'external_status_id' => data_get($response, 'status'),
           'tracking_url'       => data_get($response, 'tracking'),
           'label_url'          => route('admin.shipping-label.zippin', $order->shipping->id)
        ]);

        $order->feed()->create([
            'event'         => OrderFeedEvent::ShippingUpdate,
            'presentation'  => OrderFeedPresentation::Icon,
            'initializator' => Auth::user()->name,
            'comments'      => "ID de envío generado: " . data_get($response, 'id'),
            'action'        => 'generó la orden de envío con Zippin, el correo encargado será ' . $order->shipping->provider_carrier,
            'meta'          => [
                'icon_code'   => 'local_shipping'
            ]
        ]);
    }

    public function downloadLabel(OrderShipping $shipping)
    {
        $response = Http::withBasicAuth($this->key('zippin_key'), $this->key('zippin_secret'))
                    ->withQueryParameters([
                        'what'   => 'label',
                        'format' => 'pdf'
                    ])
                    ->get("$this->base_url/shipments/$shipping->external_id/documentation")
                    ->json();

        return response(base64_decode($response['body']), 200, ['Content-Type' => 'application/pdf']);
    }

    public function getStatus(OrderShipping $shipping)
    {
        return Http::withBasicAuth($this->key('zippin_key'), $this->key('zippin_secret'))
                    ->get("$this->base_url/shipments/$shipping->external_id")
                    ->json();
    }

    public function syncStatus(OrderShipping $shipping)
    {
        $statusResponse = $this->getStatus($shipping);

        $currentStatusName = data_get($statusResponse, 'status_name');
        $currentStatusId = data_get($statusResponse, 'status');

        if ($currentStatusId === 'documentation_ready' && $shipping->status != ShippingStatus::Confirmed)
        {
            $shipping->update([
                'status'             => ShippingStatus::Confirmed,
                'external_status'    => $currentStatusName,
                'external_status_id' => $currentStatusId,
                'tracking_code'      => data_get($statusResponse, 'carrier_tracking_id')
            ]);

            $shipping->order->feed()->create([
                'event'         => OrderFeedEvent::ShippingUpdate,
                'presentation'  => OrderFeedPresentation::Image,
                'initializator' => 'Zippin',
                'action'        => "confirmó el ingreso de la orden de envío y ya se encuentra disponible su documentación",
                'meta'          => [
                    'img_src'   => Storage::url('providers/zippin_icon.png')
                ]
            ]);
        }

        if ($currentStatusId === 'ready_to_ship' && $shipping->status != ShippingStatus::DispatchReady)
        {
            $shipping->update([
                'status'             => ShippingStatus::DispatchReady,
                'external_status'    => $currentStatusName,
                'external_status_id' => $currentStatusId,
                'tracking_code'      => data_get($statusResponse, 'carrier_tracking_id')
            ]);

            $shipping->order->update(['status' => OrderStatus::DispatchReady]);

            $shipping->order->feed()->create([
                'event'         => OrderFeedEvent::ShippingUpdate,
                'presentation'  => OrderFeedPresentation::Image,
                'initializator' => 'Zippin',
                'action'        => "procesó correctamente la orden de envío y ya está lista para ser despachada",
                'meta'          => [
                    'img_src'   => Storage::url('providers/zippin_icon.png')
                ]
            ]);
        }

        if ($currentStatusId === 'cancelled' && $shipping->status != ShippingStatus::Cancelled)
        {
            $shipping->update([
                'status'             => ShippingStatus::Cancelled,
                'external_status'    => $currentStatusName,
                'external_status_id' => $currentStatusId
            ]);

            $shipping->order->feed()->create([
                'event'         => OrderFeedEvent::ShippingUpdate,
                'presentation'  => OrderFeedPresentation::Image,
                'initializator' => 'Zippin',
                'action'        => "confirmó la cancelación del envío",
                'meta'          => [
                    'img_src'   => Storage::url('providers/zippin_icon.png')
                ]
            ]);
        }

        if ($currentStatusId === 'rejected' && $shipping->status != ShippingStatus::CarrierRejected)
        {
            $shipping->update([
                'status'             => ShippingStatus::CarrierRejected,
                'external_status'    => $currentStatusName,
                'external_status_id' => $currentStatusId
            ]);

            $shipping->order->feed()->create([
                'event'         => OrderFeedEvent::ShippingUpdate,
                'presentation'  => OrderFeedPresentation::Image,
                'initializator' => 'Zippin',
                'action'        => "informó que el transportista rechazó el envío, el mismo será devuelto",
                'meta'          => [
                    'img_src'   => Storage::url('providers/zippin_icon.png')
                ]
            ]);
        }

        if (in_array($currentStatusId, ['shipped', 'in_transit_to_crossdock', 'admitted']) 
        && $shipping->status != ShippingStatus::Dispatched)
        {
            $shipping->update([
                'status'             => ShippingStatus::Dispatched,
                'external_status'    => $currentStatusName,
                'external_status_id' => $currentStatusId
            ]);

            $shipping->order->update(['status' => OrderStatus::Dispatched]);

            $shipping->order->feed()->create([
                'event'         => OrderFeedEvent::ShippingUpdate,
                'presentation'  => OrderFeedPresentation::Image,
                'initializator' => 'El pedido',
                'action'        => "fue despachado correctamente y ya está en manos de Zippin",
                'meta'          => [
                    'img_src'   => Storage::url('providers/zippin_icon.png')
                ]
            ]);
        }

        if (in_array($currentStatusId, [
            'crossdock', 'in_transit_to_carrier', 'received_by_carrier', 'in_transit'
        ]) && $shipping->status != ShippingStatus::InTransit)
        {
            $shipping->update([
                'status'             => ShippingStatus::InTransit,
                'external_status'    => $currentStatusName,
                'external_status_id' => $currentStatusId
            ]);

            $shipping->order->update(['status' => OrderStatus::InTransit]);

            $shipping->order->feed()->create([
                'event'         => OrderFeedEvent::ShippingUpdate,
                'presentation'  => OrderFeedPresentation::Image,
                'initializator' => 'El pedido',
                'action'        => "ya está en camino",
                'meta'          => [
                    'img_src'   => Storage::url('providers/zippin_icon.png')
                ]
            ]);
        }

        if ($currentStatusId === 'out_for_delivery' && $shipping->status != ShippingStatus::DeliveryNear)
        {
            $shipping->update([
                'status'             => ShippingStatus::DeliveryNear,
                'external_status'    => $currentStatusName,
                'external_status_id' => $currentStatusId
            ]);

            $shipping->order->feed()->create([
                'event'         => OrderFeedEvent::ShippingUpdate,
                'presentation'  => OrderFeedPresentation::Image,
                'initializator' => 'Zippin',
                'action'        => "informa que el transportista está cerca del destino",
                'meta'          => [
                    'img_src'   => Storage::url('providers/zippin_icon.png')
                ]
            ]);
        }

        if ($currentStatusId === 'available_for_pickup' && $shipping->status != ShippingStatus::InBranch)
        {
            $shipping->update([
                'status'             => ShippingStatus::InBranch,
                'external_status'    => $currentStatusName,
                'external_status_id' => $currentStatusId
            ]);

            $shipping->order->update(['status' => OrderStatus::InBranch]);

            $shipping->order->feed()->create([
                'event'         => OrderFeedEvent::ShippingUpdate,
                'presentation'  => OrderFeedPresentation::Icon,
                'initializator' => $shipping->order->user->full_name,
                'action'        => "ya puede pasar a retirar el pedido en la sucursal elegida",
                'meta'          => [
                    'icon_code'  => 'store',
                    'icon_color' => 'emerald'
                ]
            ]);
        }

        if (in_array($currentStatusId, ['delivered', 'delivered_with_damage']) 
        && $shipping->status != ShippingStatus::Delivered)
        {
            $shipping->update([
                'status'             => ShippingStatus::Delivered,
                'external_status'    => $currentStatusName,
                'external_status_id' => $currentStatusId
            ]);

            $shipping->order->update(['status' => OrderStatus::Delivered]);

            $shipping->order->feed()->create([
                'event'         => OrderFeedEvent::ShippingUpdate,
                'presentation'  => OrderFeedPresentation::Icon,
                'initializator' => "Zippin",
                'action'        => "informó que el pedido se entrego correctamente",
                'meta'          => [
                    'icon_code'  => 'done',
                    'icon_color' => 'green'
                ]
            ]);
        }

        if (in_array($currentStatusId, ['lost', 'lost_in_carrier']) 
        && $shipping->status != ShippingStatus::Sinister)
        {
            $shipping->update([
                'status'             => ShippingStatus::Sinister,
                'external_status'    => $currentStatusName,
                'external_status_id' => $currentStatusId
            ]);

            $shipping->order->feed()->create([
                'event'         => OrderFeedEvent::ShippingUpdate,
                'presentation'  => OrderFeedPresentation::Icon,
                'initializator' => "Zippin",
                'action'        => "reportó un siniestro en el envío, contactate urgentemente",
                'meta'          => [
                    'icon_code'  => 'error',
                    'icon_color' => 'red'
                ]
            ]);
        }

        $shipping->refresh();

        if ($shipping->external_status_id != $currentStatusId)
        {
            $shipping->update([
                'external_status'    => $currentStatusName,
                'external_status_id' => $currentStatusId
            ]);
        }
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
