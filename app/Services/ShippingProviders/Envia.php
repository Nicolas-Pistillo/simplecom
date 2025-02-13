<?php

namespace App\Services\ShippingProviders;

use App\Enums\LogisticType;
use App\Interfaces\ShippingProvider;
use App\Models\Order;
use App\Models\OrderShipping;
use App\Services\CartService;
use App\Traits\Configurable;
use App\Utils\Address;
use App\Utils\ShippingBranch;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

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

    public function createOrder(Order $order)
    {
        
    }

    public function getStatus(OrderShipping $shipping)
    {
        
    }

    public function getRates(ShippingRateParameters $parameters): Collection
    {
        $origins = $this->getOrigins();
        $origin = $origins->first();

        $services = $this->getServices();
        $rates = collect();

        $package = $this->calculatePackage();

        if (!$package || $services->isEmpty()) return $rates;

        foreach ($services as $service) 
        {
            $rateBody = json_encode([
                'origin' => [
                    'name'       => $origin['name'],
                    'company'    => $origin['company'],
                    'street'     => $origin['street'],
                    'email'      => $origin['email'],
                    'phone'      => $origin['phone'],
                    'number'     => $origin['number'],
                    'postalCode' => $origin['postal_code'],
                    'city'       => $origin['city'],
                    'state'      => $origin['state'],
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
            ]);

            $serviceRate = $this->getRate($rateBody)->first();

            if (!$serviceRate || empty($serviceRate)) continue;

            $shippingRate = new ShippingRate([
                'source'        => 'envia',
                'source_name'   => 'Envia.com',
                'source_logistic_type' => data_get($service, 'drop_off'),
                'source_data'   => $serviceRate,
                'label'         => data_get($serviceRate, 'serviceDescription'),
                'service_id'    => data_get($serviceRate, 'serviceId'),
                'service_name'  => data_get($serviceRate, 'serviceDescription'),
                'logistic_type' => data_get($this->logistic_type_parser, data_get($service, 'drop_off')),
                'carrier_id'    => data_get($serviceRate, 'carrierId'),
                'carrier_name'  => data_get($serviceRate, 'carrierDescription'),
                'carrier_logo'  => data_get($service, 'logo'),
                'price'         => data_get($serviceRate, 'totalPrice'),
                'estimate'      => data_get($serviceRate, 'deliveryEstimate')
            ]);

            foreach ($serviceRate['branches'] as $branch) 
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

        return $rates;
    }

    public function getRate($rateBody)
    {
        return Http::withToken($this->token)->withBody($rateBody)->post("$this->api_base_url/ship/rate")->collect('data');
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
