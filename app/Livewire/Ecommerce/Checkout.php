<?php

namespace App\Livewire\Ecommerce;

use App\Livewire\Forms\CheckoutForm;
use App\Services\EnviaService;
use App\Traits\Livewire\WithNotifications;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use App\Services\ProductService;
use Illuminate\Support\Facades\Http;
use App\Enums\PaymentRedirectType;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Log;

class Checkout extends Component
{
    use WithNotifications;

    public CheckoutForm $form;

    public $current_step = 1;

    public $shipping_rates, $selected_shipping;

    public $payment_methods, $selected_payment_method;

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

    public function confirmOrder()
    {
        try 
        {
            $paymentMethod = PaymentMethod::find($this->selected_payment_method);

            $service = $paymentMethod->service();
    
            if ($service->redirect_type === PaymentRedirectType::None)
            {
                dd("termina aca el checkout");
            }
    
            $service->generateCheckout(['id' => 123]);
    
            if ($service->redirect_type === PaymentRedirectType::ProviderPlatform)
                $this->redirect($service->provider_checkout_url);
            
    
            if ($service->redirect_type === PaymentRedirectType::FrontendCheckout)
                $this->dispatch("$paymentMethod->code-checkout", $service->frontend_payload);

        } catch (\Throwable $th) 
        {
            $this->notify([
                'type'  => 'danger',
                'title' => 'Error al crear el pedido',
                'body'  => 'Por favor, vuelva a intentarlo más tarde'
            ]);

            Log::error("Error al generar un pedido", [
                'tenant'            => tenant('name'),
                'payment_method'    => $paymentMethod->code,
                'exception_message' =>  $th->getMessage()
            ]);
        }
    }

    public function mount()
    {
        $this->payment_methods = PaymentMethod::where('active', true)->get();
    }

    public function render()
    {
        return view('livewire.ecommerce.checkout');
    }
}