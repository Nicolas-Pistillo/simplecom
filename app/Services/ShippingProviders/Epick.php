<?php

namespace App\Services\ShippingProviders;

use App\Enums\LogisticType;
use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Enums\OrderStatus;
use App\Enums\ShippingStatus;
use App\Interfaces\ShippingProvider;
use App\Models\CollectionPoint;
use App\Models\Order;
use App\Models\OrderShipping;
use App\Models\UserAddress;
use App\Services\CartService;
use App\Traits\Configurable;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Epick implements ShippingProvider
{
    use Configurable;

    protected $configuration_keys = ['epick_phone', 'epick_password'];

    private $token;

    public function generateToken()
    {
        $response = Http::withBody(json_encode([
            'phone'    => $this->key('epick_phone'),
            'password' => $this->key('epick_password'),
            'source'   => 'API'
        ]))
        ->post("https://e-pick.com.ar/api/users/login")
        ->json();

        if (isset($response['id'], $response['token']))
        {
            $this->token = $response['token'];
        }
    }

    public function getRates(ShippingRateParameters $parameters): Collection
    {
        $rates = collect();

        $cartPackage = CartService::getPackageInfo('kg');

        $collectionPoint = CollectionPoint::inUse();

        if (!$collectionPoint) return $rates;

        $response = Http::withBody(json_encode([
            'sender' => [
                'postal_code' => $collectionPoint->zipcode_number
            ],
            'addressee' => [
                'postal_code' => $parameters->recipient_address->zipcode_number
            ],
            'package' => [
                "long"   => data_get($cartPackage, 'dimensions.length'),
                "width"  => data_get($cartPackage, 'dimensions.width'),
                "height" => data_get($cartPackage, 'dimensions.height'),
                "weight" => data_get($cartPackage, 'dimensions.weight'),
                "value"  => data_get($cartPackage, 'declaredValue')
            ]
        ]))
        ->get('https://www.e-pick.com.ar/api/orders/calculator/www')
        ->object();

        if (!isset($response->isValid) || !$response->isValid) return $rates;

        $estimate = $response->eta[0] . '-' . $response->eta[1] . ' días';

        $rates->push(new ShippingRate([
            'source'              => 'epick',
            'source_name'         => "Epick",
            'source_data'         => $response,
            'label'               => "E-Pick - Envío a domicilio",
            'carrier_logo'        => Storage::url('providers/epick.png'),
            'service_id'          => 'epick_sipping',
            'service_name'        => 'Servicio puerta a puerta',
            'logistic_type'       => LogisticType::OriginToDoor,
            'price'               => data_get($response, 'price'),
            'estimate'            => $estimate
        ]));

        return $rates;
    }

    public function createOrder(Order $order)
    {
        $this->generateToken();

        $origin = CollectionPoint::inUse();

        if (!$this->token)
            throw new Exception('Error al comunicarse con los servicios de E-pick');

        if (!$origin)
            throw new Exception('No hay un punto de colecta en uso');

        $destination = $order->shipping?->userAddress;

        if (!$destination || !$destination instanceof UserAddress)
            throw new Exception('Error al recuperar los datos del destino de envío');

        $package = $order->calculatePackage();

        $body = [
            'info' => [
                'webhook' => $order->shippingWebhook()
            ],
            'package' => [
                'long'   => data_get($package, 'dimensions.length'),
                'width'  => data_get($package, 'dimensions.width'),
                'height' => data_get($package, 'dimensions.height'),
                'weight' => data_get($package, 'weight'),
                'value'  => data_get($package, 'declaredValue')
            ],
            'sender' => [
                'name'        => tenant('ecommerce_name'),
                'postal_code' => $origin->zipcode_number,
                'phone'       => $origin->staff_phone,
                'email'       => $origin->staff_email,
                'street'      => $origin->street,
                'number'      => $origin->number,
                'city'        => $origin->locality,
                'province'    => $origin->state,
                'extra'       => $origin->references,
                'info'        => $origin->observations
            ],
            'addressee' => [
                'name'        => $order->user->full_name,
                'phone'       => $order->user->phone,
                'email'       => $order->user->email,
                'postal_code' => $destination->zipcode_number,
                'street'      => $destination->street,
                'number'      => $destination->number,
                'city'        => $destination->locality,
                'province'    => $destination->state,
                'extra'       => $destination->references
            ]
        ];

        $response = Http::withHeader('x-access-token', $this->token)
                        ->withBody(json_encode($body))
                        ->throw()
                        ->post('https://e-pick.com.ar/api/orders/integrations/confirm-order')
                        ->json();

        if (!isset($response['id'], $response['created_at']))
            throw new Exception('Error al crear la orden de envío con E-pick');

        $order->shipping->update([
            'status'                      => ShippingStatus::OrderPayPending,
            'external_id'                 => data_get($response, 'id'),
            'checkout_url'                => data_get($response, 'mp_url'),
            'final_price'                 => data_get($response, 'total'),
            'external_status'             => data_get($response, 'status'),
            'external_status_description' => data_get($response, 'status_name'),
            'order_created_at'            => Carbon::parse(data_get($response, 'created_at'))->format('Y-m-d H:i:s'),
            'meta'                        => [
                [
                    'name'      => 'Código QR',
                    'internal'  => true,
                    'type'      => 'image',
                    'value'     => data_get($response, 'qr_image')
                ]
            ]
        ]);

        $order->update(['status' => OrderStatus::DispatchReady]);

        $order->feed()->create([
            'event'         => OrderFeedEvent::ShippingUpdate,
            'presentation'  => OrderFeedPresentation::Icon,
            'initializator' => 'E-pick',
            'action'        => 'recibió la orden de envío, debés abonarla para confirmarla',
            'meta'          => [
                'icon_code' => 'local_shipping'
            ]
        ]);
    }

    public function getStatus(OrderShipping $shipping)
    {
        
    }
}