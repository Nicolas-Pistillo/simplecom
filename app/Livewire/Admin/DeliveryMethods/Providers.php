<?php

namespace App\Livewire\Admin\DeliveryMethods;

use App\Models\CollectionPoint;
use App\Models\Configuration;
use App\Models\ShippingProvider;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;

class Providers extends Component
{
    use WithNotifications;

    protected $listeners = [
        'collection-point-created' => '$refresh',
        'collection-point-asigned' => '$refresh',
        'collection-point-deleted' => '$refresh'
    ];

    public $providers, $configuring_provider, $configuring_provider_keys;

    public function configProvider(ShippingProvider $provider)
    {
        $this->configuring_provider = $provider;
        $this->configuring_provider_keys = $provider->service()->getconfigurableFields()->toArray();

        $this->dispatch('open-provider-config');
    }

    public function saveProviderConfig()
    {
        foreach($this->configuring_provider_keys as $field)
        {
            if ($field['required'] && empty(trim($field['value'])))
            {
                return $this->addError($field['key'], "El campo {$field['display_name']} no puede estar vacío");
            }
        }

        foreach($this->configuring_provider_keys as $field)
        {
            Configuration::find($field['id'])->update(['value' => $field['value']]);
        }

        $this->dispatch('close-provider-config');
        
        $this->notify([
            'type'  => 'success',
            'title' => 'Configuración actualizada'
        ]);
    }

    public function toggleProviderActive(ShippingProvider $provider)
    {
        $provider->update(['active' => !$provider->active]);

        $action = $provider->active ? 'Activaste' : 'Desactivaste';

        $this->notify([
            'type'  => 'success',
            'title' => "$action $provider->name"
        ]);
    }

    public function mount()
    {
        $this->providers = ShippingProvider::orderByDesc('active')->get();
    }

    public function render()
    {
        return view('livewire.admin.delivery-methods.providers', [
            'collection_point' => CollectionPoint::inUse()
        ]);
    }
}
