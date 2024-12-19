<?php

namespace App\Livewire\Admin\DeliveryMethods;

use App\Enums\ShippingMethodType;
use App\Models\ShippingMethod;
use Livewire\Component;

class Upsert extends Component
{
    public function getShippingProviders()
    {
        return ShippingMethod::where('type', '!=', ShippingMethodType::Own)
                                ->orderBy('name')
                                ->get();
    }

    public function getOwnShippingMethods()
    {
        return ShippingMethod::where('type', ShippingMethodType::Own)->orderBy('name')->get();
    }

    public function getPickingPoints()
    {
        
    }

    public function render()
    {
        return view('livewire.admin.delivery-methods.upsert', [
            'shipping_providers'   => $this->getShippingProviders(),
            'own_shipping_methods' => $this->getOwnShippingMethods(),
        ]);
    }
}
