<?php

namespace App\Livewire\Ecommerce\Customer\Settings;

use App\Models\UserAddress;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;

class Addresses extends Component
{
    use WithNotifications;

    protected $listeners = ['new-address-created' => '$refresh'];

    public $target_address, $tag, $details, $floor, $apartment, $office;

    public function editAddressDetails(UserAddress $address)
    {
        $this->fill([
            'target_address' => $address,
            'tag'            => $address->tag,
            'details'        => $address->details,
            'floor'          => $address->floor,
            'apartment'      => $address->apartment,
            'office'         => $address->office
        ]);
        
        $this->dispatch('open-edit-address-details');
    }

    public function deleteAddress(UserAddress $address)
    {
        $address->delete();

        $this->notify([
            'type'  => 'success',
            'title' => 'Dirección eliminada',
            'body'  => "Eliminaste la dirección $address->summary"
        ]);

        $this->reset();

        $this->dispatch('close-confirm-delete-address');
    }

    public function updateAddressDetails()
    {
        $this->target_address->update($this->only('tag', 'details', 'floor', 'apartment', 'office'));

        $this->notify([
            'type'  => 'success',
            'title' => 'Dirección actualizada',
            'body'  => "Actualizaste los detalles de esta dirección correctamente"
        ]);

        $this->dispatch('close-edit-address-details');
    }

    public function render()
    {
        return view('livewire.ecommerce.customer.settings.addresses');
    }
}
