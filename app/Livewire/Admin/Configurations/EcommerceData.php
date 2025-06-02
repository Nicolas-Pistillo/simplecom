<?php

namespace App\Livewire\Admin\Configurations;

use App\Livewire\Forms\EcommerceDataConfiguration;
use App\Models\Configuration;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EcommerceData extends Component
{
    use WithFileUploads, WithNotifications;

    public EcommerceDataConfiguration $form;

    public function updatedForm($value, $property)
    {
        if ($property === 'ecommerce_logo')
        {
            $this->form->logo_preview = $this->form->ecommerce_logo->temporaryUrl();
        }
    }

    public function save()
    {
        $this->form->validate();

        tenant()->update([
            'ecommerce_name' => $this->form->ecommerce_name,
            'color'          => $this->form->selected_color
        ]);

        if ($this->form->ecommerce_logo)
        {
            Storage::delete(tenant('logo_url'));
            tenant()->update(['logo_url' => $this->form->ecommerce_logo->store(tenant('name'))]);
        }

        foreach($this->form->getMassiveUpdateFields() as $key => $value)
        {
            Configuration::where('key', $key)->update(compact('value'));
        }

        $this->notify([
            'type'  => 'success',
            'title' => 'Configuración guardada',
            'body'  => 'Los datos de tu comercio han sido actualizados correctamente'
        ]);
    }

    public function mount()
    {
        $this->form->autocomplete();
    }

    public function render()
    {
        return view('livewire.admin.configurations.ecommerce-data');
    }
}
