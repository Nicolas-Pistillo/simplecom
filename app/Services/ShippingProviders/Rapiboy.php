<?php

namespace App\Services\ShippingProviders;

use App\Enums\LogisticType;
use App\Interfaces\ShippingProvider;
use App\Models\Order;
use App\Models\OrderShipping;
use App\Services\CartService;
use App\Traits\Configurable;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class Rapiboy implements ShippingProvider
{
    use Configurable;

    protected $configuration_keys = ['rapiboy_api_token'];

    public function getRates(ShippingRateParameters $parameters): Collection
    {
        $rates = collect();

        $cartPackage = CartService::getPackageInfo('kg');

        $response = Http::withHeader('Token', $this->key('rapiboy_api_token'))
                        ->withBody(json_encode([
                            'CPOrigen'  => '1879',
                            'CPDestino' => $parameters->recipient_address->zipcode_number,
                            'Bultos'    => [
                                [
                                    'Largo'     => data_get($cartPackage, 'dimensions.length'),
                                    'Ancho'     => data_get($cartPackage, 'dimensions.width'),
                                    'Alto'      => data_get($cartPackage, 'dimensions.height'),
                                    'Peso'      => data_get($cartPackage, 'dimensions.weight'),
                                    'Cantidad'  => 1
                                ]
                            ]
                        ]))
                        ->get('https://uat.rapiboy.com/v1/NextDaySmart/Cotizar')
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

    public function createOrder(?Order $order)
    {
        
    }

    public function getStatus(OrderShipping $shipping)
    {
        
    }
}