<?php

namespace App\Livewire\Admin\DeliveryMethods\CustomShippings;

use App\Livewire\Forms\CustomShippingForm;
use App\Models\Province;
use App\Services\Georef;
use Livewire\Component;

class Upsert extends Component
{
    public CustomShippingForm $form;

    public $province_search = '';

    public function toggleProvince($provinceId)
    {
        in_array($provinceId, $this->form->selected_provinces)
            ? array_splice($this->form->selected_provinces, array_search($provinceId, $this->form->selected_provinces), 1)
            : array_push($this->form->selected_provinces, $provinceId);
    }

    public function toggleLocality($localityId)
    {
        in_array($localityId, $this->form->excluded_localities)
            ? array_splice($this->form->excluded_localities, array_search($localityId, $this->form->excluded_localities), 1)
            : array_push($this->form->excluded_localities, $localityId);
    }

    public function render()
    {
        return view('livewire.admin.delivery-methods.custom-shippings.upsert', [
            'provinces' => Province::with('localities')->orderBy('name')->get()
        ]);
    }
}
