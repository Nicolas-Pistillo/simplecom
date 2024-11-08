<?php

namespace App\Livewire\Ecommerce;

use App\Services\ProductService;
use App\Traits\Livewire\WithNotifications;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartPanel extends Component
{
    use WithNotifications;

    protected $listeners = ['updated-cart' => '$refresh'];

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

        Cart::update($rowId, $newQty);

        $this->notify([
            'type'      => 'success',
            'title'     => 'Carrito actualizado',
            'position'  => 'top-left'
        ]);

        $this->dispatch('updated-cart');
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
