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
use App\Traits\Configurable;
use App\Utils\Address;
use App\Utils\ShippingBranch;
use App\Utils\ShippingRate;
use App\Utils\ShippingRateParameters;
use Exception;
use Illuminate\Support\Carbon;
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
        $this->base_url = env('ANDREANI_TEST') 
                        ? 'https://apisqa.andreani.com' 
                        : 'https://apis.andreani.com';
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
        $toHomeRates = $this->getToHomeRate($parameters);
        $branchRates = $this->getBranchRate($parameters);

        return $toHomeRates->merge($branchRates);
    }

    public function createOrder(Order $order)
    {
        $this->generateToken();

        $origin = CollectionPoint::inUse();

        if (!$this->token)
            throw new Exception('Error al comunicarse con los servicios de Andreani');

        if (!$origin)
            throw new Exception('No hay un punto de colecta en uso');

        $package = $order->calculatePackage();

        $body = [
            'remitente' => [
                'nombreCompleto'  => $origin->staff_name,
                'eMail'           => $origin->staff_email,
                'documentoTipo'   => 'DNI',
                'documentoNumero' => $origin->staff_document,
                'telefono'       => [
                    'tipo'   => 1,
                    'numero' => $origin->staff_phone
                ]
            ],
            'destinatario' => [
                [
                    'nombreCompleto'  => $order->user->full_name,
                    'eMail'           => $order->user->email,
                    'documentoTipo'   => 'DNI',
                    'documentoNumero' => $order->user->document,
                    'telefono'       => [
                        'tipo'   => 1,
                        'numero' => $order->user->phone
                    ]
                ]
            ],
            'origen' => [
                'postal' => [
                    'localidad'     => $origin->locality,
                    'codigoPostal'  => $origin->zipcode_number,
                    'calle'         => $origin->street,
                    'numero'        => $origin->number
                ],
                'componentesDeDireccion' => [
                    [
                        'meta' => 'Referencias',
                        'contenido' => $origin->references
                    ]
                ]
            ],
            'bultos' => [
                [
                    'kilos'   => data_get($package, 'weight'),
                    'volumen' => data_get($package, 'dimensions.volume')
                ]
            ]   
        ];

        if (in_array($order->shipping->logistic_type, [LogisticType::OriginToDropoff, LogisticType::DropoffToDropoff]))
        {
            $body['contrato'] = $this->key('andreani_contrato_sucursal');
            $body['destino']['sucursal']['id'] = strval(data_get($order->shipping->selected_branch, 'external_id'));
        } else
        {
            $body['contrato'] = $this->key('andreani_contrato_domicilio');
            $body['destino']['postal'] = [
                'localidad'     => $order->shipping->userAddress->locality,
                'codigoPostal'  => $order->shipping->userAddress->zipcode_number,
                'calle'         => $order->shipping->userAddress->street,
                'numero'        => $order->shipping->userAddress->number,
                'componentesDeDireccion' => [
                    [
                        'meta'      => 'Referencias',
                        'contenido' => $order->shipping->userAddress->references
                    ]
                ]
            ];
        }

        $response = Http::withHeader('x-authorization-token', $this->token)
                        ->withBody(json_encode($body))
                        ->post("$this->base_url/v2/ordenes-de-envio")
                        ->throw()
                        ->json();

        if (!isset($response['estado']) || !isset($response['fechaCreacion']))
            throw new Exception('Error al generar orden de envío con Andreani');
        
        $order->shipping->update([
            'status'           => ShippingStatus::Created,
            'external_id'      => data_get($response, 'bultos.0.numeroDeEnvio'),
            'external_status'  => data_get($response, 'estado'),
            'label_code'       => data_get($response, 'agrupadorDeBultos'),
            'label_url'        => route('admin.shipping-label.andreani', $order->shipping->id),
            'order_created_at' => Carbon::parse(data_get($response, 'fechaCreacion'))->format('Y-m-d H:i:s'),
            'meta'            => [
                [
                    'name'  => 'Fecha de creación',
                    'value' => Carbon::parse(data_get($response, 'fechaCreacion'))->format('d/m/Y H:i:s')
                ],
                [
                    'name'  => 'Número de Permisionaria',
                    'value' => data_get($response, 'numeroDePermisionaria')
                ],
                [
                    'name'  => 'Descripción de servicio',
                    'value' => data_get($response, 'descripcionServicio')
                ],
                [
                    'name'  => 'Sucursal distribución',
                    'value' => data_get($response, 'sucursalDeDistribucion.descripcion')
                ],
                [
                    'name'  => 'Sucursal rendición',
                    'value' => data_get($response, 'sucursalDeRendicion.descripcion')
                ],
            ]
        ]);

        $order->update(['status' => OrderStatus::DispatchReady]);

        $order->feed()->create([
            'event'         => OrderFeedEvent::ShippingUpdate,
            'presentation'  => OrderFeedPresentation::Image,
            'initializator' => 'Andreani',
            'action'        => 'recibió la orden de envío para el pedido, se espera que se acepte y se procese a la brevedad',
            'meta'          => [
                'img_src'  => Storage::url('providers/andreani_icon.png')
            ]
        ]);
    }

    public function getStatus(OrderShipping $shipping)
    {
        $this->generateToken();

        return Http::withHeader('x-authorization-token', $this->token)
                        ->get("$this->base_url/v2/envios/$shipping->external_id")
                        ->json();
    }

    public function getLabelPdf($packageGrouper)
    {
        $this->generateToken();

        return Http::withHeader('x-authorization-token', $this->token)
                    ->get("$this->base_url/v2/ordenes-de-envio/$packageGrouper/etiquetas")
                    ->body();
    }

    public function getToHomeRate(ShippingRateParameters $parameters): Collection
    {
        $cartPackage = CartService::getPackageInfo('kg');

        $response = Http::withQueryParameters([
            'cpDestino' => $parameters->recipient_address->zipcode_number,
            'contrato'  => $this->key('andreani_contrato_domicilio'),
            'cliente'   => $this->key('andreani_nro_cliente'),
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
            'cliente'   => $this->key('andreani_nro_cliente'),
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