<?php

namespace App\Livewire\Ecommerce;

use App\Models\WishlistItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Wishlist extends Component
{
    protected $listeners = ['updated-wishlist' => '$refresh'];

    public function removeItem(WishlistItem $item)
    {
        $item->delete();
    }

    public function render()
    {
        return view('livewire.ecommerce.wishlist', [
            'wishlist' => Auth::user()->wishlist()->with('product')->orderBy('created_at', 'DESC')->get()
        ]);
    }
}
