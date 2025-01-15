<?php

namespace App\Services\ShippingProviders;

use App\Enums\LogisticType;
use App\Interfaces\ShippingProvider;
use App\Services\CartService;
use App\Traits\Configurable;
use App\Utils\Address;
use App\Utils\ShippingBranch;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Andreani implements ShippingProvider
{
    use Configurable;

    protected $configuration_keys = [
        'andreani_nro_cliente', 'andreani_user', 'andreani_password', 
        'andreani_contrato_domicilio', 'andreani_contrato_sucursal'
    ];

    private $base_url, $token;

    public function __construct()
    {
        $this->base_url = env('ANDREANI_TEST') ? 'https://apisqa.andreani.com' : 'https://apis.andreani.com';
    }

    public function generateToken()
    {
        $response = Http::withBody(json_encode([
            'userName' => $this->key('andreani_user'),
            'password' => $this->key('andreani_password')
        ]))
        ->post("$this->base_url/login")
        ->json();

        $this->token = data_get($response, 'token');
    }

    public function getRates(ShippingRateParameters $parameters): Collection
    {
        $rates = collect();

        $this->generateToken();

        if (!$this->token) return $rates;

        $toHomeRates = $this->getToHomeRate($parameters);
        $branchRates = $this->getBranchRate($parameters);

        return $toHomeRates->merge($branchRates);
    }

    public function createOrder()
    {
        
    }

    public function getToHomeRate(ShippingRateParameters $parameters): Collection
    {
        $cartPackage = CartService::getPackageInfo('kg');

        $response = Http::withQueryParameters([
            'cpDestino' => $parameters->recipient_address->zipcode_number,
            'contrato'  => $this->key('andreani_contrato_domicilio'),
            'cliente'   => '0012006460',
            'bultos'    => [
                [
                    'valor' => data_get($cartPackage, 'declaredValue'),
                    'kilos' => data_get($cartPackage, 'dimensions.weight')
                ]
            ]
        ])
        ->get("$this->base_url/v1/tarifas")
        ->json();

        if (empty($response) || !isset($response['tarifaConIva'])) return collect();

        return collect()->push(new ShippingRate([
            'source'        => 'andreani',
            'source_name'   => 'Andreani',
            'source_data'   => $response,
            'label'         => 'Andreani - Envío a domicilio',
            'service_name'  => 'Servicio a domicilio',
            'logistic_type' => LogisticType::OriginToDoor,
            'carrier_name'  => 'Andreani',
            'carrier_logo'  => Storage::url('providers/andreani_icon.png'),
            'price_no_tax'  => data_get($response, 'tarifaSinIva.total'),
            'price'         => data_get($response, 'tarifaConIva.total'),
            'estimate'      => '72hs hábiles'
        ]));
    }

    public function getBranchRate(ShippingRateParameters $parameters): Collection
    {
        $cartPackage = CartService::getPackageInfo('kg');

        $response = Http::withQueryParameters([
            'cpDestino' => $parameters->recipient_address->zipcode_number,
            'contrato'  => $this->key('andreani_contrato_sucursal'),
            'cliente'   => '0012006460',
            'bultos'    => [
                [
                    'valor' => data_get($cartPackage, 'declaredValue'),
                    'kilos' => data_get($cartPackage, 'dimensions.weight')
                ]
            ]
        ])
        ->get("$this->base_url/v1/tarifas")
        ->json();

        if (empty($response) || !isset($response['tarifaConIva'])) return collect();

        $andreaniBranches = $this->getBranches($parameters);

        if (!$andreaniBranches || $andreaniBranches->isEmpty()) return collect();

        $rate = new ShippingRate([
            'source'        => 'andreani',
            'source_name'   => 'Andreani',
            'source_data'   => $response,
            'label'         => 'Andreani - Envío a sucursal',
            'service_name'  => 'Servicio a sucursal',
            'logistic_type' => LogisticType::OriginToDropoff,
            'carrier_name'  => 'Andreani',
            'carrier_logo'  => Storage::url('providers/andreani_icon.png'),
            'price_no_tax'  => data_get($response, 'tarifaSinIva.total'),
            'price'         => data_get($response, 'tarifaConIva.total'),
            'estimate'      => '72hs hábiles'
        ]);

        foreach($andreaniBranches as $andreaniBranch)
        {
            $branchAddress = new Address([
                'street'    => data_get($andreaniBranch, 'direccion.calle'),
                'number'    => data_get($andreaniBranch, 'direccion.numero'),
                'zipcode'   => data_get($andreaniBranch, 'direccion.codigoPostal'),
                'locality'  => data_get($andreaniBranch, 'direccion.localidad'),
                'region'    => data_get($andreaniBranch, 'direccion.region'),
                'state'     => data_get($andreaniBranch, 'direccion.provincia'),
                'coordinates' => [
                    'lat' => data_get($andreaniBranch, 'coordenadas.latitud'),
                    'lng' => data_get($andreaniBranch, 'coordenadas.longitud')
                ]
            ]);

            /* $branchMeta = !empty(data_get($andreaniBranch, 'datosAdicionales')) 
                            ? json_encode($andreaniBranch['datosAdicionales'])
                            : null; */

            $branch = new ShippingBranch([
                'source'        => 'andreani',
                'source_name'   => 'Andreani',
                'name'          => data_get($andreaniBranch, 'descripcion'),
                'external_id'   => data_get($andreaniBranch, 'id'),
                'external_code' => data_get($andreaniBranch, 'codigo'),
                'external_type' => data_get($andreaniBranch, 'canal'),
                'phone'         => data_get($andreaniBranch, 'telefonos.0'),
                'schedule'      => data_get($andreaniBranch, 'horarioDeAtencion'),
                /* 'meta'          => $branchMeta, */
                'address'       => $branchAddress,
            ]);

            $rate->branches->push($branch);
        }

        return collect()->push($rate);
    }

    public function getBranches(ShippingRateParameters $parameters)
    {
        $response = Http::withQueryParameters([
            'seHaceAtencionAlCliente' => true,
            'codigoPostal'            => $parameters->recipient_address->zipcode_number
        ])
        ->get("$this->base_url/v2/sucursales")
        ->collect();

        if ($response || $response->isNotEmpty()) return $response;
    }
}