<?php

namespace App\Livewire\Customer;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Orders extends Component
{
    public $orders;

    public function mount()
    {
        $this->orders = Auth::user()->orders()
                                    ->with('items.product', 'items.variant.options')
                                    ->orderBy('created_at', 'DESC')
                                    ->get();
    }

    public function render()
    {
        return view('livewire.customer.orders');
    }
}
