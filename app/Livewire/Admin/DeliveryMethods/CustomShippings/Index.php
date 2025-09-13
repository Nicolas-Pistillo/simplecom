<?php

namespace App\Livewire\Admin\DeliveryMethods\CustomShippings;

use App\Models\CustomShippingMethod;
use App\Models\OriginPoint;
use App\Models\ShippingProvider;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;

class Index extends Component
{
    use WithNotifications;

    public function render()
    {
        return view('livewire.admin.delivery-methods.custom-shippings.index', [
            'methods' => CustomShippingMethod::all(),
            'origin_point' => OriginPoint::inUse()
        ]);
    }
}
