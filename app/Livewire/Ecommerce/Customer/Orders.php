<?php

namespace App\Livewire\Ecommerce\Customer;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Orders extends Component
{
    public function getOrders()
    {
        return Auth::user()->orders()
                    ->with('items')
                    ->orderBy('created_at', 'DESC')
                    ->get();
    }

    public function render()
    {
        return view('livewire.ecommerce.customer.orders', [
            'orders' => $this->getOrders()
        ]);
    }
}
