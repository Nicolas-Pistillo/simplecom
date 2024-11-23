<?php

namespace App\Livewire\Ecommerce;

use App\Livewire\Forms\CheckoutForm;
use App\Services\EnviaService;
use App\Traits\Livewire\WithNotifications;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use App\Services\ProductService;
use Illuminate\Support\Facades\Http;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use App\Enums\DeliveryType;
use Uala\SDK as Uala;

class Checkout extends Component
{
    use WithNotifications;

    public CheckoutForm $form;

    public $current_step = 1;

    public $delivery_type = DeliveryType::Picking;

    public $shipping_rates, $selected_shipping;

    public $payment_method;

    public function getShippingRates()
    {
        $this->form->validateOnly('customer_postal_code'); 

        $postal_code = $this->form->customer_postal_code;

        $envia = new EnviaService();

        $available_carriers = ['oca', 'andreani', 'correoArgentino', 'urbano'];
        $available_carrier_services = [];

        $carrier_services = $envia->getCarrierServices();

        $rates_collected = collect();

        foreach($carrier_services['data'] as $carrier_service)
        {
            if (in_array($carrier_service['carrier_name'], $available_carriers))
            {
                array_push($available_carrier_services, $carrier_service);
            }
        }

        foreach($available_carrier_services as $carrier_service)
        {
            if ($rates_collected->contains('service_id', $carrier_service['service_id'])) continue;

            $quote_params = [
                'origin' => [
                    'name'       => 'Julian Caceres',
                    'company'    => 'Andromeda Store',
                    'street'     => 'Prueba 113',
                    'number'     => '334',
                    'postalCode' => '1879',
                    'city'       => 'Quilmes Oeste',
                    'state'      => 'BA',
                    'country'    => 'AR'
                ],
                'destination' => [
                    'name'       => 'Martinsito',
                    'street'     => 'Prueba 113',
                    'number'     => '334',
                    'postalCode' => '1880',
                    'city'       => 'Berazategui',
                    'state'      => 'BA',
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
                    'carrier' => $carrier_service['carrier_name'],
                    'type'    => $carrier_service['name']
                ],
                'settings' => [
                    'printFormat' => "PDF",
                    'printSize'   => "STOCK_4X6",
                    'currency'    => 'ARS'
                ]
            ];

            $service_rates = Http::withToken(env('ENVIA_TOKEN'))->withBody(json_encode($quote_params))->post('https://api.envia.com/ship/rate')->json();

            if (isset($service_rates['meta']) && $service_rates['meta'] === 'rate' && !empty($service_rates['data']))
            {
                foreach($service_rates['data'] as $rate)
                {
                    if ($rates_collected->contains('service_id', $rate['serviceId'])) continue;

                    $rates_collected->push([
                        'carrier_id'        => $rate['carrierId'],
                        'carrier_code'      => $rate['carrier'],
                        'carrier_name'      => $rate['carrierDescription'],
                        'carrier_logo'      => $carrier_service['logo'],
                        'service_id'        => $rate['serviceId'],
                        'service_code'      => $rate['service'],
                        'service_name'      => $rate['serviceDescription'],
                        'rate_dropoff'      => $rate['dropOff'],
                        'rate_branches'     => $rate['branches'],
                        'delivery_estimate' => $rate['deliveryEstimate'],
                        'price'             => $rate['totalPrice'],
                        'total_tax'         => (!empty($rate['shipmentTaxes']) ? $rate['shipmentTaxes']['totalTax'] : null)
                    ]);
                }
            }
        }

        if ($rates_collected->isNotEmpty())
        {
            $this->shipping_rates = $rates_collected->sortBy('price');
        }
    }

    public function updatedPaymentMethod($payment_method)
    {
        if ($payment_method === 'uala')
        {
            $uala = new Uala("new_user_1631906477", "5qqGKGm4EaawnAH0J6xluc6AWdQBvLW3", "cVp1iGEB-DE6KtL4Hi7tocdopP2pZxzaEVciACApWH92e8_Hloe8CD5ilM63NppG", true);

            $ualaOrder = $uala->createOrder(15000, 'Order #1687', 'https://www.google.com', 'https://www.google.com');

            if (isset($ualaOrder->id))
            {
                dd($uala->getOrder($ualaOrder->uuid));
                $this->redirect($ualaOrder->links->checkoutLink);
            }

        }
    }

    public function selectedPayment($payment_method)
    {
        if ($payment_method === 'modo')
        {
            $req = Http::withUserAgent('Simplecom')
                        ->asJson()
                        ->withBody(json_encode(['username' => 'sdkmodostage', 'password' => 'sdkmodostage'])) 
                        ->post("https://merchants.preprod.playdigital.com.ar/merchants/middleman/token");

            $response = $req->json();

            if (isset($response['accessToken']))
            {
                $intentionReq = Http::withUserAgent('Simplecom')
                                    ->withToken($response['accessToken'])
                                    ->asJson()
                                    ->withBody(json_encode([
                                        'productName' => 'Zapatillas dupla',
                                        'price'       => 12500.60,
                                        'quantity'    => 2,
                                        'currency'    => 'ARS',
                                        'storeId'     => '2e10e1e2-1046-47a9-b5aa-12f0749940f8',
                                        'externalIntentionId' => uniqid()
                                    ]))
                                    ->post('https://merchants.preprod.playdigital.com.ar/merchants/ecommerce/payment-intention');

                $payment_intention = $intentionReq->json();

                if (isset($payment_intention['qr']))
                {
                    $this->dispatch('open-modo-checkout', $payment_intention);
                }
            }
        }
    }

    public function expressCheckout($provider)
    {
        if ($provider === 'mercadopago')
        {
            MercadoPagoConfig::setAccessToken("APP_USR-4581096489880162-110411-f051d114be77bdd34be5443dab20065a-2077542570");

            $client = new PreferenceClient();
            
            $preference = $client->create([
                'items' => [[
                    'title'      => 'Producto pruebita',
                    'quantity'   => 2,
                    'unit_price' => 3500
                ]
            ]]);

            $this->redirect($preference->init_point);
        }
    }

    public function changeQty($operation, $rowId)
    {
        $cartItem = Cart::get($rowId);
        $actualQty = $cartItem->qty;
        $variantId = $cartItem->options->variant_id;

        if ($actualQty === 1 && $operation === 'subtract') return;

        $newQty = $operation === 'subtract' ? $actualQty - 1 : $actualQty + 1;

        ProductService::validateProductSelection($newQty, $cartItem->model, [
            'variant_id'      => $variantId,
            'validator_label' => "product-$rowId-selection"
        ]);

        Cart::update($rowId, ['qty' => $newQty]);

        $this->notify([
            'type'      => 'success',
            'title'     => 'Carrito actualizado',
            'position'  => 'bottom-right'
        ]);
    }

    public function removeItem($rowId)
    {
        Cart::remove($rowId);
        
        if (Cart::count() > 0)
        {
            $this->notify([
                'type'      => 'success',
                'title'     => 'Carrito actualizado',
                'position'  => 'bottom-right'
            ]);
        }
    }

    public function setStep($step)
    {
        $this->current_step = $step;
    }

    public function render()
    {
        return view('livewire.ecommerce.checkout');
    }
}
