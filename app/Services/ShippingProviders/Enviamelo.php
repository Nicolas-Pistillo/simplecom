<?php

namespace App\Services\ShippingProviders;

use App\Enums\LogisticType;
use App\Enums\NotificationPresentation;
use App\Enums\OrderFeedEvent;
use App\Enums\ShippingStatus;
use App\Interfaces\ShippingProvider;
use App\Models\Order;
use App\Models\OrderShipping;
use App\Models\UserAddress;
use App\Services\CartService;
use App\Services\OrderService;
use App\Traits\Configurable;
use App\Utils\Address;
use App\Utils\ShippingBranch;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class Enviamelo implements ShippingProvider
{
    use Configurable;

    protected $configuration_keys = ['enviamelo_token'];

    private $base_url = 'https://api.enviamelo.com.ar/api/v1';

    public function getRates(ShippingRateParameters $parameters): Collection
    {
        $cartPackage = CartService::getPackageInfo();

        $rates = collect();

        $results = Http::withToken($this->key('enviamelo_token'))
                        ->withBody(json_encode([
                            'weight'      => data_get($cartPackage, 'weight'),
                            'postal_code' => $parameters->recipient_address->zipcode_number
                        ]))
                        ->post("$this->base_url/price")
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

    public function createOrder(Order $order)
    {
        $package = OrderService::calculatePackage($order);

        $width = data_get($package, 'dimensions.width');
        $height = data_get($package, 'dimensions.height');
        $length = data_get($package, 'dimensions.length');

        $body = [
            'weight'              => data_get($package, 'weight'),
            'unit'                => 'KG',
            'dimensions'          => $width . 'x' . $height . 'x' . $length,
            'term'                => $order->shipping->provider_service,
            'recipient_name'      => $order->user->name,
            'recipient_last_name' => $order->user->lastname,
            'recipient_dni'       => $order->user->document,
            'recipient_phone'     => $order->user->phone,
            'recipient_email'     => $order->user->email,
            'product'             => 'Productos',
            'note'                => "Pedido $order->id"
        ];

        if ($order->shipping->logistic_type->isToDoor())
        {
            $destiny = $order->shipping->userAddress;

            $body['retirement'] = 'client';
            $body['retirement_item'] = [
                'province'    => $destiny->state,
                'location'    => $destiny->locality,
                'street'      => $destiny->street,
                'height'      => $destiny->number,
                'postal_code' => $destiny->zipcode_number
            ];

            if (!empty($destiny->apartment))
                $body['retirement_item']['departament'] = $destiny->apartment;

            if (!empty($destiny->floor))
                $body['retirement_item']['floor'] = $destiny->floor;

            if (!empty($destiny->references) && trim($destiny->references) != '')
                $body['retirement_item']['note'] = trim($destiny->references);
            
        }

        if ($order->shipping->logistic_type->isToDropoff())
        {
            $body['retirement'] = 'point';
            $body['retirement_point_id'] = $order->shipping->selected_branch_id;
        }

        $response = Http::withToken($this->key('enviamelo_token'))
                        ->withBody(json_encode($body))
                        ->post("$this->base_url/operation")
                        ->json();

        if (!$response || !isset($response['data'], $response['data']['id']))
            throw new Exception('Error al generar orden de envío con Envíamelo, intente de nuevo más tarde');

        $order->shipping->update([
            'status'          => ShippingStatus::OrderPayPending,
            'external_id'     => data_get($response, 'data.id'),
            'external_status' => data_get($response, 'data.status'),
            'tracking_code'   => data_get($response, 'data.tracking_deonics'),
            'label_url'       => data_get($response, 'data.pdf')
        ]);
    
        $order->feed()->create([
            'event'         => OrderFeedEvent::ShippingUpdate,
            'presentation'  => NotificationPresentation::Icon,
            'initializator' => Auth::user()->name,
            'action'        => 'generó la orden de envío con Envíamelo y debe ser abonada para confirmarla',
            'meta'          => [
                'icon_code' => 'local_shipping'
            ]
        ]);
    }

    public function getStatus(OrderShipping $shipping)
    {
        return Http::withToken($this->key('enviamelo_token'))
                    ->get("$this->base_url/tracking?transaction_id=$shipping->external_id")
                    ->json();
    }

    public function syncStatus(OrderShipping $shipping)
    {
        $statusResponse = $this->getStatus($shipping);
        
        // Consultar lista de estados al Responsable de operaciones
    }

    public function getPickupPoints(UserAddress|Address $destination): Collection
    {
        $response = Http::withToken($this->key('enviamelo_token'))
                    ->withBody(json_encode([
                        'postal_code' => $destination->zipcode_number
                    ]))
                    ->post("$this->base_url/points")
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