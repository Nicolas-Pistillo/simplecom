<?php

namespace App\Livewire\Admin\DeliveryMethods;

use App\Models\ShippingProvider;
use Livewire\Component;

class Upsert extends Component
{
    public function render()
    {
        return view('livewire.admin.delivery-methods.upsert', [
            'shipping_providers' => ShippingProvider::orderBy('name')->get()
        ]);
    }
}
