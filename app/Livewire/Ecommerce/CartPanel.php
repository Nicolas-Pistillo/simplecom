<?php

namespace App\Livewire\Ecommerce;

use App\Models\ProductVariant;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CartPanel extends Component
{
    protected $listeners = ['updated-cart' => '$refresh'];

    public function substractUnit($rowId)
    {
        dd($rowId);
    }

    public function addUnit($rowId)
    {
        $cartItem = Cart::get($rowId);
        $actualQty = $cartItem->qty;

        if ($cartItem->options->variant_id)
        {
            $variant = ProductVariant::find($cartItem->options->variant_id);

            Validator::make(
                [
                    'more_than_stock'    => $cartItem->qty,
                    'less_than_min_sale' => $cartItem->qty,
                    'more_than_max_sale' => $cartItem->qty
                ],
                [],
                []
            )->validate();

            dd($variant);


        } else {
            dd("ESTE PRODUCTO NO TIENE VARIANTES");
        }
    }

    public function removeItem($rowId)
    {
        $this->dispatch('updated-cart');
        Cart::remove($rowId);
    }

    public function render()
    {
        return view('livewire.ecommerce.cart-panel');
    }
}
