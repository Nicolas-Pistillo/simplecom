<?php

namespace App\Livewire\Admin\DeliveryMethods;

use App\Models\StorePickup;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;

class StorePickups extends Component
{
    use WithNotifications;

    protected $listeners = ['new-store-pickup-created' => '$refresh'];

    public $store_pickup;
    public $pickup_name, $pickup_schedule, $pickup_observations, $pickup_floor, $pickup_local;

    public function toggleStorePickupActive(StorePickup $storePickup)
    {
        $storePickup->update(['active' => !$storePickup->active]);

        $action = $storePickup->active ? 'Activaste' : 'Desactivaste';

        $this->notify([
            'type'  => 'success',
            'title' => "$action $storePickup->name"
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

    public function deleteStorePickup()
    {
        $this->store_pickup->delete();

        $this->notify([
            'type'  => 'success',
            'title' => 'Punto de retiro eliminado',
            'body'  => "Eliminaste el punto {$this->store_pickup->name}"
        ]);

        $this->reset('store_pickup');

        $this->dispatch('close-confirm-storepickup-deletion');
    }

    public function render()
    {
        return view('livewire.admin.delivery-methods.store-pickups', [
            'store_pickups' => StorePickup::all()
        ]);
    }
}
