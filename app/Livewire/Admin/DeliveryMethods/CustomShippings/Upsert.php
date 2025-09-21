<?php

namespace App\Livewire\Admin\DeliveryMethods\CustomShippings;

use App\Livewire\Forms\CustomShippingForm;
use App\Models\CustomShippingMethod;
use App\Models\Locality;
use App\Models\Province;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upsert extends Component
{
    use WithNotifications, WithFileUploads;

    public $method;
    public CustomShippingForm $form;

    public $target_province;
    public $target_province_localities;
    public $target_province_search;

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

    public function setTargetProvince(Province $province)
    {
        $this->target_province_search = '';
        $this->target_province = $province;
        $this->target_province_localities = $province->localities;

        $this->dispatch('open-target-province');
    }

    public function updatedTargetProvinceSearch()
    {
        $this->target_province_localities = $this->target_province->localities()
            ->where('name', 'like', '%' . $this->target_province_search . '%')
            ->get();
    }

    public function updatedFormLogo()
    {
        $this->form->logo_preview = $this->form->logo->temporaryUrl();
    }

    public function addZipcodeRange()
    {
        array_push($this->form->zipcode_ranges, [
            'from' => '',
            'to'   => ''
        ]);
    }

    public function deleteZipcodeRange($index)
    {
        array_splice($this->form->zipcode_ranges, $index, 1);
    }

    public function validateForm()
    {
        $this->form->validate();
        $this->dispatch('open-confirm');
    }

    public function mount($method = null)
    {
        if ($method)
        {
            $method = CustomShippingMethod::findOrFail($method);

            $this->method = $method;
            $this->form->autocomplete($method);
        }
    }

    public function save()
    {
        $method = CustomShippingMethod::updateOrCreate(
            [
                'id' => $this->method?->id
            ],
            [
                'name' => $this->form->name,
                'estimated_delivery' => $this->form->estimated_delivery,
                'price' => $this->form->price,
                'active' => $this->form->active,
                'shipping_zone_type' => $this->form->shipping_zone_type,
                'selected_provinces' => $this->form->selected_provinces,
                'excluded_localities' => $this->form->excluded_localities,
                'zipcode_selection_type' => $this->form->zipcode_selection_type,
                'zipcode_ranges' => $this->form->zipcode_ranges, 
                'zipcode_list' => $this->form->zipcode_list,
                'distance_km' => $this->form->distance_km,
                'conditions' => $this->form->conditions
            ]
        );

        if ($this->form->logo) 
        {
            if ($this->method && !empty($this->method->logo_url))
                Storage::delete($this->method->logo_url);

            $imagePath = $this->form->logo->store(tenant('custom_shipping_logos_url'));
            $method->update(['logo_url' => $imagePath]);
        }

        session()->flash('method-saved', 'Datos de envío guardados correctamente.');

        return $this->redirectRoute('admin.delivery-methods.custom-shippings.index');
    }

    public function render()
    {
        $provinces = Province::with('localities')->orderBy('name')->get();
        $selectedProvinces = $provinces->whereIn('id', $this->form->selected_provinces);

        return view('livewire.admin.delivery-methods.custom-shippings.upsert', [
            'provinces' => $provinces,
            'selectedProvinces' => $selectedProvinces,
            'excludedLocalities' => Locality::findMany($this->form->excluded_localities)
        ]);
    }
}
