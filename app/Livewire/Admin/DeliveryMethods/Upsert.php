<?php

namespace App\Livewire\Admin\DeliveryMethods;

use App\Models\Configuration;
use App\Models\ShippingProvider;
use App\Models\StorePickup;
use App\Traits\Livewire\WithNotifications;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Upsert extends Component
{
    use WithNotifications;

    protected $listeners = ['new-store-pickup-created' => '$refresh'];

    public $providers, $configuring_provider, $configuring_provider_keys;

    public $store_pickup;
    public $pickup_name, $pickup_schedule, $pickup_observations, $pickup_floor, $pickup_local;

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
            'title' => "$action $provider->name con éxito"
        ]);
    }

    public function editStorePickup(StorePickup $storePickup)
    {
        $this->store_pickup = $storePickup;

        $this->fill([
            'pickup_name'         => $storePickup->name,
            'pickup_schedule'     => $storePickup->schedule,
            'pickup_observations' => $storePickup->observations,
            'pickup_floor'        => $storePickup->floor,
            'pickup_local'        => $storePickup->local
        ]);

        $this->dispatch('open-edit-store-pickup');
    }

    public function updateStorePickup()
    {
        $this->validate([
            'pickup_name'     => 'required|string|max:50',
            'pickup_schedule' => 'required|string|max:80'
        ], [], [
            'pickup_name'     => 'nombre',
            'pickup_schedule' => 'horarios'
        ]);

        $this->store_pickup->update([
            'name'         => $this->pickup_name,
            'schedule'     => $this->pickup_schedule,
            'observations' => $this->pickup_observations,
            'floor'        => $this->pickup_floor,
            'local'        => $this->pickup_local,
        ]);

        $this->dispatch('close-edit-store-pickup');

        $this->notify([
            'type'  => 'success',
            'title' => 'Punto de retiro actualizado'
        ]);

        $this->reset('store_pickup', 'pickup_name', 'pickup_schedule', 'pickup_floor', 'pickup_local');
    }

    public function confirmDeleteStorePickup(StorePickup $storePickup)
    {
        $this->store_pickup = $storePickup;
        $this->dispatch('open-confirm-storepickup-deletion');
    }

    public function deleteStorePickup(StorePickup $storePickup)
    {
        $storePickup->delete();

        $this->notify([
            'type'  => 'success',
            'title' => 'Punto de retiro eliminado'
        ]);

        $this->dispatch('close-confirm-storepickup-deletion');
    }

    public function mount()
    {
        $this->providers = ShippingProvider::orderByDesc('active')->get();
    }

    public function render()
    {
        return view('livewire.admin.delivery-methods.upsert', [
            'store_pickups' => StorePickup::all()
        ]);
    }
}
