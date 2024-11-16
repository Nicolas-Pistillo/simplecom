<?php

namespace App\Livewire\Ecommerce;

use App\Livewire\Forms\CheckoutForm;
use App\Traits\Livewire\WithNotifications;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use App\Services\ProductService;
use Illuminate\Support\Facades\Http;

class Checkout extends Component
{
    use WithNotifications;

    public CheckoutForm $form;

    public $shippingOption;

    public function checkUser()
    {
        $dataJson = '{
    "origin": {
        "name": "Alex",
        "company": "envia",
        "email": "noreply@envia.com",
        "phone": "8110000ewdased000",
        "street": "shreeji sadan 24 bhandarkar rd",
        "number": "opposite matunga kabutar khana",
        "district": "",
        "city": "Monterrey",
        "state": "NL",
        "category": 1,
        "country": "MX",
        "postalCode": "66236",
        "reference": "",
        "coordinates": {
            "latitude": "19.027686",
            "longitude": "72.853462"
        }
    },
    "destination": {
        "name": "new delhi",
        "company": "new delhi",
        "email": "new@delhi.com",
        "phone": "8180000000",
        "street": "yashwant place commercial complex",
        "number": "123",
        "district": "",
        "city": "Monterrey",
        "state": "NL",
        "category": 1,
        "country": "MX",
        "postalCode": "66236",
        "reference": "",
        "coordinates": {
            "latitude": "28.578938",
            "longitude": "77.165053"
        }
    },
    "packages": [
        {
            "content": "shoes",
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
        "carrier": "fedex",
        "service": "ground",
        "type": 1
    },
    "settings": {
        "printFormat": "PDF",
        "printSize": "STOCK_4X6",
        "currency": "USD",
        "cashOnDelivery" :"1000.00",
        "comments": ""
    },
    "additionalServices": []
}';

        $req = Http::withToken(env('ENVIA_TOKEN'))
                ->withBody($dataJson)
                ->post('https://api-test.envia.com/ship/rate');

        dd($req->json() ?? $req->status());
        
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
