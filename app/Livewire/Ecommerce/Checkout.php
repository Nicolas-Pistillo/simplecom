<?php

namespace App\Livewire\Ecommerce;

use App\Livewire\Forms\CheckoutForm;
use App\Traits\Livewire\WithNotifications;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use App\Services\ProductService;
use Illuminate\Support\Facades\Http;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class Checkout extends Component
{
    use WithNotifications;

    public CheckoutForm $form;

    public $current_step = 'shipping';

    public $shipping_options, $selected_shipping;

    public function checkAddress()
    {
        $this->form->validateOnly('customer_postal_code'); 

        $postal_code = $this->form->customer_postal_code;

        $providers = Http::withToken(env('ENVIA_TEST_TOKEN'))->get("https://queries-test.envia.com/available-carrier/AR/0")->json();
        $location_data = Http::get("https://geocodes.envia.com/zipcode/AR/$postal_code")->json();

        // dd($providers);

        $dataJson = '{
            "origin": {
                "name": "Julian Caceres",
                "company": "Andromeda Store",
                "email": "noreply@andromedastore.com",
                "phone": "11405060",
                "street": "Prueba 113",
                "number": "334",
                "postalCode": "1879",
                "city": "Quilmes Oeste",
                "state": "BA",
                "category": 1,
                "country": "AR"
            },
            "destination": {
                "name": "Martinsito",
                "email": "noreply@andromedastore.com",
                "phone": "11405060",
                "street": "Prueba 113",
                "number": "334",
                "postalCode": "1880",
                "city": "Berazategui",
                "state": "BA",
                "category": 1,
                "country": "AR"
            },
            "packages": [
                {
                    "content": "zapatillas jordan",
                    "boxCode": "",
                    "amount": 1,
                    "type": "box",
                    "weight": 1,
                    "insurance": 0,
                    "declaredValue": 0,
                    "weightUnit": "KG",
                    "lengthUnit": "CM",
                    "dimensions": {
                        "length": 11,
                        "width": 15,
                        "height": 20
                    }
                }
            ],
            "shipment": {
                "carrier": "correoArgentino",
                "type": "priority_suc"
            },
            "settings": {
                "printFormat": "PDF",
                "printSize": "STOCK_4X6",
                "currency": "ARS"
            }
        }';

        $req = Http::withToken(env('ENVIA_TEST_TOKEN'))
                ->withBody($dataJson)
                ->post('https://api-test.envia.com/ship/rate');

        dd($req->json() ?? $req->status());
        
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

    public function shippingStep()
    {
        $this->current_step = 'shipping';
    }

    public function customerStep()
    {
        $this->current_step = 'customer';
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

    public function render()
    {
        return view('livewire.ecommerce.checkout');
    }
}
