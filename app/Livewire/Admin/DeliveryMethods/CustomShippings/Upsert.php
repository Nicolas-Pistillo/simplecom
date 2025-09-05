<?php

namespace App\Livewire\Admin\DeliveryMethods\CustomShippings;

use App\Livewire\Forms\CustomShippingForm;
use App\Services\Georef;
use Livewire\Component;

class Upsert extends Component
{
    public CustomShippingForm $form;

    public function toggleProvince($province)
    {
        in_array($province, $this->form->selected_provinces)
            ? array_splice($this->form->selected_provinces, array_search($province, $this->form->selected_provinces), 1)
            : array_push($this->form->selected_provinces, $province);
    }

    public function render()
    {
        return view('livewire.admin.delivery-methods.custom-shippings.upsert', [
            'provinces' => Georef::getProvinces()
        ]);
    }
}
