<?php

namespace App\Livewire\Ecommerce;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartPanel extends Component
{
    protected $listeners = ['updatedCart' => '$refresh'];

    public function removeAll()
    {
        Cart::destroy();
    }

    public function render()
    {
        return view('livewire.ecommerce.cart-panel');
    }
}
