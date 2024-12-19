<?php 

namespace App\Services\ShippingProviders;

use App\Enums\LogisticType;
use App\Models\UserAddress;
use App\Services\CartService;
use App\Traits\Configurable;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class EnvioPack
{
    use Configurable;

    protected $configuration_keys = ['enviopack_api_key', 'enviopack_secret_key'];

    private $base_url = "https://api.enviopack.com";
    private $token;

    private $service_name_parser = [
        'N' => 'Servicio estándar', 
        'P' => 'Servicio prioritario',
        'X' => 'Servicio express',
        'R' => 'Servicio de devoluciones'
    ];

    private $logistic_type_parser = [
        'D' => [
            'D' => LogisticType::OriginToDoor,
            'S' => LogisticType::OriginToDropoff
        ],
        'S' => [
            'D' => LogisticType::DropoffToDoor,
            'S' => LogisticType::DropoffToDropoff
        ]
    ];

    public function __construct()
    {
        $this->generateToken();
    }

    public function getRates(ShippingRateParameters $parameters)
    {
        $provinceId = $this->getProvinceIdByState($parameters->recipient_address->state);

        $rates = collect();

        $cartPackage = CartService::getPackageInfo('kg');

        if (!$cartPackage) return $rates;

        $packageHeight = data_get($cartPackage, 'dimensions.height');
        $packageWidth  = data_get($cartPackage, 'dimensions.width');
        $packageLength = data_get($cartPackage, 'dimensions.length');

        $rateBody = [
            'access_token'  => $this->token,
            'provincia'     => $provinceId,
            'codigo_postal' => $parameters->recipient_address->zipcode_number,
            'peso'          => data_get($cartPackage, 'dimensions.weight'),
            'paquetes'      => $packageHeight . 'x' . $packageWidth . 'x' . $packageLength
        ];

        $response = $this->getRate($rateBody);

        if ($response->isEmpty()) return $rates;

        foreach($response as $result)
        {
            if ($result['servicio'] == 'R') continue;

            $carrierName  = data_get($result, 'correo.nombre');

            $dispatchType = data_get($result, 'despacho');

            $modality     = data_get($result, 'modalidad');

            $serviceCode  = data_get($result, 'servicio');

            $serviceName  = data_get($this->service_name_parser, $serviceCode);

            $logisticType = data_get($this->logistic_type_parser, "$dispatchType.$modality");

            $deliveryDate = Carbon::createFromFormat('d/m/Y', data_get($result, 'fecha_estimada'));

            $dayDifference = now()->diffInDays($deliveryDate);

            $estimate = in_array($dayDifference, [0, 1])
                        ? 'Entre hoy y mañana'
                        : "$dayDifference días";

            $destinationType = $modality == 'D' ? 'domicilio' : 'sucursal';

            $rates->push(new ShippingRate([
                'source'                => 'enviopack',
                'source_name'           => 'EnvioPack',
                'source_data'           => $result,
                'label'                 => "$carrierName - $serviceName a $destinationType",
                'service_id'            => $serviceCode,
                'service_name'          => $serviceName,
                'logistic_type'         => $logisticType,
                'source_logistic_type'  => "$dispatchType - $modality",
                'carrier_id'            => data_get($result, 'correo.id'),
                'carrier_name'          => $carrierName,
                'price'                 => data_get($result, 'valor'),
                'estimate'              => $estimate
            ]));
        }

        return $rates;
    }

    public function getRate($rateBody)
    {
        return Http::withQueryParameters($rateBody)->acceptJson()->get("$this->base_url/cotizar/costo")->collect();
    }

    public function generateToken()
    {
        $response = Http::asForm()->acceptJson()->post("$this->base_url/auth", [
            'api-key'    => env('ENVIOPACK_API_KEY'),
            'secret-key' => env('ENVIOPACK_SECRET_KEY')
        ])->json();

        $this->token = $response['token'] ?? false;
    }

    public function getProvinceIdByState($state)
    {
        $provinces = $this->getProvinces();

        $province = $provinces->where('nombre', $state)->first();

        return $province['id'] ?? null;
    }

    public function getCarriers()
    {
        return Http::acceptJson()->get("$this->base_url/correos?access_token=$this->token&filtrar_activos=1")->collect();
    }

    public function getProvinces()
    {
        return Http::acceptJson()->get("$this->base_url/provincias?access_token=$this->token")->collect();
    }
}