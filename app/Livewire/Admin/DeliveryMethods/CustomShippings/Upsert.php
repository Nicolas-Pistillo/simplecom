<?php

namespace App\Livewire\Admin\DeliveryMethods\CustomShippings;

use App\Livewire\Forms\CustomShippingForm;
use App\Models\Locality;
use App\Models\Province;
use App\Services\Georef;
use Livewire\Component;

class Upsert extends Component
{
    public CustomShippingForm $form;

    public $localitySearch = [];

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

    public function updatedForm($value, $prop)
    {
        if (in_array($prop, ['shipping_zone_type', 'selected_provinces']))
        {
            $this->localitySearch = [];
        }
    }

    public function render()
    {
        $provinces = Province::with('localities')->orderBy('name')->get();
        $selectedProvinces = $provinces->whereIn('id', $this->form->selected_provinces);

        $selectedProvinces->each(function ($province) 
        {
            $search = $this->localitySearch[$province->id] ?? '';

            $province->setRelation(
                'localities',
                $province->localities()->where('name', 'LIKE', "%$search%")
                                        ->orderBy('name')
                                        ->get()
            );
        });

        return view('livewire.admin.delivery-methods.custom-shippings.upsert', [
            'provinces' => $provinces,
            'selectedProvinces' => $selectedProvinces,
            'excludedLocalities' => Locality::findMany($this->form->excluded_localities)
        ]);
    }
}
