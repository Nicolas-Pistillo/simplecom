<?php

namespace App\Livewire\Admin\DeliveryMethods\CustomShippings;

use App\Enums\ShippingZoneType;
use App\Enums\ZipcodeSelectionType;
use App\Livewire\Forms\CustomShippingForm;
use App\Models\Locality;
use App\Models\Province;
use App\Services\Georef;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upsert extends Component
{
    use WithNotifications, WithFileUploads;

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

    public function updatedFormLogo()
    {
        $this->form->logo_preview = $this->form->logo->temporaryUrl();
    }

    public function addZipcodeRange()
    {
        array_push($this->form->zipcodes_ranges, [
            'from' => '',
            'to'   => ''
        ]);
    }

    public function deleteZipcodeRange($index)
    {
        array_splice($this->form->zipcodes_ranges, $index, 1);
    }

    public function save()
    {
        $this->form->validate();

        dump($this->form->all());
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
