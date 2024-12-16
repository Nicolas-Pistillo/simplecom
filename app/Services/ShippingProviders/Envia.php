<?php 

namespace App\Services\ShippingProviders;

use App\Models\UserAddress;
use App\Utils\ShippingRate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class Envia
{
    private $token;

    private $api_base_url = 'https://api.envia.com';
    private $queries_base_url = 'https://queries.envia.com';

    public function __construct()
    {
        $this->token = env('ENVIA_TOKEN');

        if (env('ENVIA_TEST'))
        {
            $this->token = env('ENVIA_TEST_TOKEN');

            $this->api_base_url = 'https://api-test.envia.com';
            $this->queries_base_url = 'https://queries-test.envia.com';
        }
    }

    public function getRates(UserAddress $destination)
    {
        $origins = $this->getOrigins();

        $origin = $origins->first();

        $carriers = $this->getCarriers();

        $rates = collect();

        foreach($carriers as $carrier)
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
                    'name'       => 'Ramon Díaz',
                    'street'     => $destination->street,
                    'number'     => $destination->number,
                    'postalCode' => $destination->zipcode_number,
                    'city'       => $destination->locality,
                    'state'      => $destination->state_code,
                    'country'    => 'AR'
                ],
                'packages' => [
                    [
                        'content'       => 'zapatillas jordan',
                        'boxCode'       => '',
                        'amount'        => 1,
                        'type'          => 'box',
                        'weight'        => 1,
                        'insurance'     => 0,
                        'declaredValue' => 0,
                        'weightUnit'    => 'KG',
                        'lengthUnit' => 'CM',
                        'dimensions' => [
                            'length' => 11,
                            'width' => 15,
                            'height' => 20
                        ]
                    ]
                ],
                'shipment' => [
                    'carrier' => $carrier['name'],
                ],
                'settings' => [
                    'printFormat' => "PDF",
                    'printSize'   => "PAPER_7X4.75",
                    'currency'    => 'ARS'
                ]
            ]);

            $carrierRates = $this->calculateRate($rateBody);

            if ($carrierRates->isNotEmpty())
            {
                $carrierRates->each(function($rate) use ($rates)
                {
                    $shippingRate = new ShippingRate([
                        'source'        => 'envia',
                        'source_name'   => 'Envia.com',
                        'service_id'    => $rate['serviceId'],
                        'service_name'  => $rate['serviceDescription'],
                        'carrier_id'    => $rate['carrierId'],
                        'carrier_name'  => $rate['carrierDescription'],
                        'carrier_logo'  => URL::to("img/providers/{$rate['carrier']}.svg"),
                        'price'         => $rate['totalPrice'],
                        'estimate'      => $rate['deliveryEstimate']
                    ]);

                    if (!empty($rate['branches']))
                    {
                        foreach($rate['branches'] as $branch)
                        {
                            $shippingRate->branches->push($branch);
                        }
                    }

                    $rates->push($shippingRate);
                });
            }
        }

        return $rates;
    }

    public function calculateRate($rateBody)
    {
        return Http::withToken($this->token)->withBody($rateBody)->post("$this->api_base_url/ship/rate")->collect('data');
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