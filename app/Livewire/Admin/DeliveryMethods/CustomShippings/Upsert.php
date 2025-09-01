<?php

namespace App\Livewire\Admin\DeliveryMethods\CustomShippings;

use App\Livewire\Forms\CustomShippingForm;
use Livewire\Component;

class Upsert extends Component
{
    public CustomShippingForm $form;

    public function render()
    {
        return view('livewire.admin.delivery-methods.custom-shippings.upsert');
    }
}
