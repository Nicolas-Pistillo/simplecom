<?php

namespace App\Services\ShippingProviders;

use App\Enums\LogisticType;
use App\Interfaces\ShippingProvider;
use App\Services\CartService;
use App\Traits\Configurable;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class Epick implements ShippingProvider
{
    use Configurable;

    protected $configuration_keys = ['epick_phone', 'epick_password'];

    public function getRates(ShippingRateParameters $parameters): Collection
    {
        $rates = collect();

        $cartPackage = CartService::getPackageInfo('kg');

        $response = Http::withBody(json_encode([
            'sender' => [
                'postal_code' => '1879'
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

        if (!isset($response->isValid) || !isset($response->price)) return $rates;

        $estimate = $response->eta[0] . '-' . $response->eta[1] . ' días';

        $rates->push(new ShippingRate([
            'source'              => 'epick',
            'source_name'         => "Epick",
            'source_data'         => $response,
            'label'               => "E-Pick - Envío a domicilio",
            'carrier_logo'        => URL::to('img/providers/epick.png'),
            'service_id'          => 'ship',
            'logistic_type'       => LogisticType::OriginToDoor,
            'price'               => data_get($response, 'price'),
            'estimate'            => $estimate
        ]));

        return $rates;
    }

    public function createOrder()
    {
        
    }
}