<?php 

namespace App\Services\ShippingProviders;

use App\Enums\LogisticType;
use App\Models\UserAddress;
use App\Services\CartService;
use App\Traits\Configurable;
use App\Utils\Address;
use App\Utils\ShippingBranch;
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

    public function getRates(ShippingRateParameters $parameters)
    {
        $rates = collect();
        
        $this->generateToken();

        if (!$this->token) return $rates;

        $cartPackage = CartService::getPackageInfo('kg');
        $provinceId = $this->getProvinceIdByName($parameters->recipient_address->state);

        if (!$cartPackage || !$provinceId) return $rates;

        $localityId = $this->getLocalityIdByUserAddress($provinceId, $parameters->recipient_address);

        $packageHeight = data_get($cartPackage, 'dimensions.height');
        $packageWidth  = data_get($cartPackage, 'dimensions.width');
        $packageLength = data_get($cartPackage, 'dimensions.length');

        $rateBody = [
            'access_token'  => $this->token,
            'provincia'     => $provinceId,
            'localidad'     => $localityId,
            'codigo_postal' => $parameters->recipient_address->zipcode_number,
            'peso'          => data_get($cartPackage, 'dimensions.weight'),
            'paquetes'      => $packageHeight . 'x' . $packageWidth . 'x' . $packageLength
        ];

        $shippingRates = $this->getToHomeRates($rateBody);
        $dropoffRates = $this->getDropOffRates($rateBody);

        $rates->push($shippingRates, $dropoffRates);

        return $rates->collapse();
    }

    public function getToHomeRates($rateBody): Collection
    {
        $rateBody['modalidad'] = 'D';

        $response = Http::withQueryParameters($rateBody)->acceptJson()->get("$this->base_url/cotizar/costo")->collect();

        $rates = collect();

        if ($response->isEmpty()) return $rates;

        $response = $response->where('servicio', '!=', 'R')->sortBy('valor')->take(3);

        foreach($response as $result)
        {
            $carrierName  = data_get($result, 'correo.nombre');

            $dispatchType = data_get($result, 'despacho');

            $serviceCode  = data_get($result, 'servicio');

            $serviceName  = data_get($this->service_name_parser, $serviceCode);

            $logisticType = data_get($this->logistic_type_parser, "$dispatchType.D");

            $deliveryDate = Carbon::createFromFormat('d/m/Y', data_get($result, 'fecha_estimada'));

            $dayDifference = now()->diffInDays($deliveryDate);

            $estimate = in_array($dayDifference, [0, 1])
                        ? 'Entre hoy y mañana'
                        : "$dayDifference días";

            $rates->push(new ShippingRate([
                'source'                => 'enviopack',
                'source_name'           => 'EnvioPack',
                'source_data'           => $result,
                'label'                 => "$carrierName - $serviceName a domicilio",
                'service_id'            => $serviceCode,
                'service_name'          => $serviceName,
                'logistic_type'         => $logisticType,
                'source_logistic_type'  => "$dispatchType - D",
                'carrier_id'            => data_get($result, 'correo.id'),
                'carrier_name'          => $carrierName,
                'price'                 => data_get($result, 'valor'),
                'estimate'              => $estimate
            ]));
        }

        return $rates;
    }

    public function getDropOffRates($rateBody): Collection
    {
        $response = Http::withQueryParameters($rateBody)->acceptJson()->get("$this->base_url/cotizar/precio/a-sucursal")->collect();

        $rates = collect();

        if ($response->isEmpty()) return $rates;

        $response = $response->where('servicio', '!=', 'R');

        foreach($response as $result)
        {
            $carrierName = data_get($result, 'sucursal.correo.nombre');

            $serviceName = data_get($this->service_name_parser, data_get($result, 'servicio'));

            $shippingRate = new ShippingRate([
                'source'                => 'enviopack',
                'source_name'           => 'EnvioPack',
                'source_data'           => $result,
                'label'                 => "$carrierName - $serviceName a sucursal",
                'service_id'            => data_get($result, 'servicio'),
                'service_name'          => $serviceName,
                'logistic_type'         => LogisticType::OriginToDropoff,
                'source_logistic_type'  => "D - S",
                'carrier_id'            => data_get($result, 'sucursal.correo.id'),
                'carrier_name'          => $carrierName,
                'price'                 => data_get($result, 'valor'),
                'estimate'              => data_get($result, 'horas_entrega') . ' horas hábiles'
            ]);

            $branchAddress = new Address([
                'street'   => data_get($result, 'sucursal.calle'),
                'number'   => data_get($result, 'sucursal.numero'),
                'zipcode'  => data_get($result, 'sucursal.codigo_postal'),
                'locality' => data_get($result, 'sucursal.localidad.nombre'),
                'state'    => data_get($result, 'sucursal.provincia.nombre'),
                'coordinates' => [
                    'lat' => data_get($result, 'sucursal.latitud'),
                    'lng' => data_get($result, 'sucursal.longitud'),
                ]
            ]);

            $branch = new ShippingBranch([
                'source'        => 'enviopack',
                'source_name'   => 'EnvioPack',
                'name'          => data_get($result, 'sucursal.nombre'),
                'price'         => $shippingRate->price,
                'external_id'   => data_get($result, 'sucursal.id'),
                'external_code' => data_get($result, 'sucursal.codigo'),
                'phone'         => data_get($result, 'sucursal.telefono'),
                'schedule'      => data_get($result, 'sucursal.horario'),
                'address'       => $branchAddress,
                'meta'          => [
                    'id_locality' => data_get($result, 'sucursal.localidad.id'),
                    'id_province' => data_get($result, 'sucursal.provincia.id')
                ]
            ]);

            $shippingRate->branches->push($branch);

            $rates->push($shippingRate);
        }

        return $rates;
    }

    public function getSellerRates($rateBody)
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

    public function getProvinceIdByName($provinceName)
    {
        $provinces = $this->getProvinces();

        $province = $provinces->where('nombre', $provinceName)->first();

        return $province['id'] ?? null;
    }

    public function getLocalityIdByUserAddress($provinceId, UserAddress $address)
    {
        $localities = $this->getLocalities($provinceId);

        $locality = $localities->filter(function($locality) use ($address) 
        {
            return strtolower($locality['nombre'])  == strtolower($address->locality)  OR
                   strtolower($locality['partido']) == strtolower($address->locality)  OR
                   strtolower($locality['barrio'])  == strtolower($address->locality);
        })->first();

        return $locality['id'] ?? null;
    }

    public function getCarriers()
    {
        return Http::acceptJson()->get("$this->base_url/correos?access_token=$this->token&filtrar_activos=1")->collect();
    }

    public function getProvinces()
    {
        return Http::acceptJson()->get("$this->base_url/provincias?access_token=$this->token")->collect();
    }

    public function getLocalities($provinceId)
    {
        return Http::acceptJson()
                    ->withQueryParameters([
                        'access_token' => $this->token,
                        'id_provincia' => $provinceId
                    ])
                    ->get("$this->base_url/localidades")
                    ->collect();
    }
}