<?php

namespace App\Livewire\Ecommerce;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartPanel extends Component
{
    protected $listeners = ['updated-cart' => '$refresh'];

    public function removeItem($rowId)
    {
        Cart::remove($rowId);
    }

    public function render()
    {
        return view('livewire.ecommerce.cart-panel');
    }
}
