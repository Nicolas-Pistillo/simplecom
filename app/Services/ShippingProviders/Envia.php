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
use App\Services\CartService;
use App\Services\OrderService;
use App\Traits\Configurable;
use App\Utils\Address;
use App\Utils\ShippingBranch;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Envia implements ShippingProvider
{
    use Configurable;

    protected $configuration_keys = ['envia_token'];

    private $token;

    private $api_base_url = 'https://api.envia.com';
    private $queries_base_url = 'https://queries.envia.com';

    private $logistic_type_parser = [ // drop_off field
        0 => LogisticType::OriginToDoor,     // Puerta a Puerta
        1 => LogisticType::DropoffToDoor,    // Sucursal a Puerta
        2 => LogisticType::OriginToDropoff,  // Puerta a Sucursal
        3 => LogisticType::DropoffToDropoff, // Sucursal a Sucursal
    ];

    public function __construct()
    {
        $this->token = $this->key('envia_token');

        if (env('ENVIA_TEST')) 
        {
            $this->api_base_url = 'https://api-test.envia.com';
            $this->queries_base_url = 'https://queries-test.envia.com';
        }
    }

    public function getRates(ShippingRateParameters $parameters): Collection
    {
        $rates = collect();

        $collectionPoint = CollectionPoint::inUse();

        if (!$collectionPoint) return $rates;

        $services = $this->getServices();
        $package = $this->calculatePackage();

        if (!$package || $services->isEmpty()) return $rates;

        foreach ($services as $service) 
        {
            if ($service['carrier_name'] === 'paquery') continue;

            $rateBody = [
                'origin' => [
                    'name'       => $collectionPoint->staff_name,
                    'company'    => tenant('ecommerce_name'),
                    'email'      => $collectionPoint->staff_email,
                    'phone'      => $collectionPoint->staff_phone,
                    'street'     => $collectionPoint->street,
                    'number'     => $collectionPoint->number,
                    'postalCode' => $collectionPoint->zipcode_number,
                    'city'       => $collectionPoint->locality,
                    'state'      => $collectionPoint->state_code,
                    'reference'  => $collectionPoint->references,
                    'country'    => 'AR'
                ],
                'destination' => [
                    'name'       => $parameters->recipient_name,
                    'email'      => $parameters->recipient_email,
                    'phone'      => $parameters->recipient_phone,
                    'street'     => $parameters->recipient_address->street,
                    'number'     => $parameters->recipient_address->number,
                    'postalCode' => $parameters->recipient_address->zipcode_number,
                    'city'       => $parameters->recipient_address->locality,
                    'state'      => $parameters->recipient_address->state_code,
                    'reference'  => $parameters->recipient_address->references,
                    'country'    => 'AR'
                ],
                'packages' => [$package],
                'shipment' => [
                    'carrier' => $service['carrier_name'],
                    'service' => $service['name']
                ],
                'settings' => [
                    'printFormat' => "PDF",
                    'printSize'   => "PAPER_7X4.75",
                    'currency'    => 'ARS',
                    'comments'    => $parameters->recipient_address->references
                ]
            ];

            $serviceRates = Http::withToken($this->token)
                                ->withBody(json_encode($rateBody))
                                ->post("$this->api_base_url/ship/rate")
                                ->collect('data');

            if (!$serviceRates || empty($serviceRates)) continue;

            foreach($serviceRates as $serviceRate)
            {
                $shippingRate = new ShippingRate([
                    'source'        => 'envia',
                    'source_name'   => 'Envia.com',
                    'source_logistic_type' => data_get($service, 'drop_off'),
                    'source_data'   => $serviceRate,
                    'label'         => data_get($serviceRate, 'serviceDescription'),
                    'service_id'    => data_get($serviceRate, 'serviceId'),
                    'service_code'  => data_get($serviceRate, 'service'),
                    'service_name'  => data_get($serviceRate, 'serviceDescription'),
                    'logistic_type' => data_get($this->logistic_type_parser, data_get($service, 'drop_off')),
                    'carrier_id'    => data_get($serviceRate, 'carrierId'),
                    'carrier_code'  => data_get($serviceRate, 'carrier'),
                    'carrier_name'  => data_get($serviceRate, 'carrierDescription'),
                    'carrier_logo'  => data_get($service, 'logo'),
                    'price'         => data_get($serviceRate, 'totalPrice'),
                    'estimate'      => data_get($serviceRate, 'deliveryEstimate')
                ]);
    
                foreach (data_get($serviceRate, 'branches', []) as $branch) 
                {
                    $branchAddress = new Address([
                        'street'      => data_get($branch, 'address.street'),
                        'number'      => data_get($branch, 'address.number'),
                        'zipcode'     => data_get($branch, 'address.postalCode'),
                        'locality'    => data_get($branch, 'address.locality'),
                        'state'       => data_get($branch, 'address.'),
                        'state_code'  => data_get($branch, 'address.province'),
                        'coordinates' => [
                            'lat' => data_get($branch, 'address.latitude'),
                            'lng' => data_get($branch, 'address.longitude')
                        ]
                    ]);
    
                    $branch = new ShippingBranch([
                        'source'        => 'envia',
                        'source_name'   => 'Envia.com',
                        'name'          => $branch['reference'],
                        'external_id'   => $branch['branch_id'],
                        'external_code' => $branch['branch_code'],
                        'external_type' => $branch['branch_type'],
                        'address'       => $branchAddress
                    ]);
    
                    $shippingRate->branches->push($branch);
                }
    
                $rates->push($shippingRate);
            }
        }

        return $rates;
    }

    public function createOrder(Order $order)
    {
        $origin = CollectionPoint::inUse();

        if (!$origin)
            throw new Exception('No hay un punto de colecta en uso');

        $package = OrderService::calculatePackage($order);

        $sourceRate = data_get($order->shipping->calculated_rate, 'source_data');

        $body = [
            'origin' => [
                'name'       => $origin->staff_name,
                'company'    => tenant('ecommerce_name'),
                'email'      => $origin->staff_email,
                'phone'      => $origin->staff_phone,
                'street'     => $origin->street,
                'number'     => $origin->number,
                'postalCode' => $origin->zipcode_number,
                'city'       => $origin->locality,
                'state'      => $origin->state_code,
                'reference'  => $origin->references,
                'country'    => 'AR'
            ],
            'destination' => [
                'name'       => $order->user->full_name,
                'email'      => $order->user->email,
                'phone'      => $order->user->phone,
                'street'     => $order->shipping->userAddress->street,
                'number'     => $order->shipping->userAddress->number,
                'postalCode' => $order->shipping->userAddress->zipcode_number,
                'city'       => $order->shipping->userAddress->locality,
                'state'      => $order->shipping->userAddress->state_code,
                'reference'  => $order->shipping->userAddress->references,
                'country'    => 'AR'
            ],
            'packages' => [
                [
                    "content" => "Productos",
                    "amount" => 1,
                    "type" => "box",
                    "dimensions" => [
                        "length" => 30,
                        "width"  => 30,
                        "height" => 45
                    ],
                    "weight" => data_get($package, 'weight'),
                    "insurance" => 0,
                    "declaredValue" => data_get($package, 'declaredValue'),
                    "weightUnit" => "KG",
                    "lengthUnit" => "CM"
                ]
            ],
            'shipment' => [
                'carrier' => data_get($sourceRate, 'carrier'),
                'service' => data_get($sourceRate, 'service')
            ],
            'settings' => [
                'printFormat' => "PDF",
                'printSize'   => "PAPER_7X4.75",
                'currency'    => 'ARS',
                'comments'    => $origin->observations
            ]
        ];

        $response = Http::withToken($this->token)
                        ->withBody(json_encode($body))
                        ->post("$this->api_base_url/ship/generate")
                        ->throw()
                        ->json();

        if (isset($response['meta']) && $response['meta'] === 'error')
            throw new Exception(data_get($response, 'error.message'));

        if (isset($response['meta']) && $response['meta'] === 'generate')
        {
            $responseData = data_get($response, 'data.0');

            $order->shipping->update([
                'status'        => ShippingStatus::DispatchReady,
                'external_id'   => data_get($responseData, 'shipmentId'),
                'tracking_code' => data_get($responseData, 'trackingNumber'),
                'tracking_url'  => data_get($responseData, 'trackUrl'),
                'label_url'     => data_get($responseData, 'label'),
                'final_price'   => data_get($responseData, 'totalPrice'),
                'meta'          => [
                    [
                        'name'  => 'Archivos adicionales',
                        'value' => data_get($responseData, 'additionalFiles')
                    ],
                    [
                        'name'  => 'Saldo a la fecha',
                        'value' => '$' . data_get($responseData, 'currentBalance')
                    ]
                ]
            ]);

            $order->update(['status' => OrderStatus::DispatchReady]);

            $order->feed()->create([
                'event'         => OrderFeedEvent::ShippingUpdate,
                'presentation'  => OrderFeedPresentation::Image,
                'initializator' => 'Envia.com',
                'action'        => 'confirmó la orden de envío',
                'comments'      => 'ID de envío generado: ' . data_get($responseData, 'shipmentId'),
                'meta'          => [
                    'img_src'  => Storage::url('providers/envia_icon.png')
                ]
            ]);
        }
    }

    public function getStatus(OrderShipping $shipping)
    {
        
    }

    public function calculatePackage(): array|false
    {
        $cartPackage = CartService::getPackageInfo('kg');

        if (!$cartPackage || empty($cartPackage)) return false;

        $package = [
            'content'       => 'Productos',
            'amount'        => 1,
            'type'          => 'box',
            'declaredValue' => $cartPackage['declaredValue'],
            'weight'        => data_get($cartPackage, 'dimensions.weight'),
            'weightUnit'    => 'KG',
            'lengthUnit'    => 'CM',
            'dimensions' => [
                'width'  => data_get($cartPackage, 'dimensions.width'),
                'height' => data_get($cartPackage, 'dimensions.height'),
                'length' => data_get($cartPackage, 'dimensions.length')
            ]
        ];

        return $package;
    }

    public function getCarriers()
    {
        return Http::withToken($this->token)->get("$this->queries_base_url/available-carrier/AR/0")->collect('data');
    }

    public function getServices()
    {
        return Http::withToken($this->token)->get("$this->queries_base_url/available-service/AR/0/1")->collect('data');
    }

    public function getOrigins()
    {
        return Http::withToken($this->token)->get("$this->queries_base_url/all-addresses/origin")->collect('data');
    }
}
