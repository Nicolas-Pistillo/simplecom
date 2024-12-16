<?php

namespace App\Livewire\Ecommerce;

use App\Models\UserAddress;
use App\Services\GoogleMaps;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class NewAddressPanel extends Component
{
    use WithNotifications;

    public $search;

    public $addresses, $selected_address;

    public $name, $apartment, $floor, $office, $details;

    public function updatedSearch()
    {
        if (strlen($this->search) <= 4) return;

        $this->addresses = GoogleMaps::autocompleteAddress($this->search);
    }

    public function selectedAddress($placeId)
    {
        $addressInfo = GoogleMaps::getPlaceDetails($placeId);

        $this->selected_address = $addressInfo;
    }

    public function removeSelectedAddress()
    {
        $this->reset('selected_address');
    }

    public function save()
    {
        try 
        {
            $newAddress = UserAddress::create([
                'user_id'         => Auth::id(),
                'name'            => $this->name,
                'zipcode'         => $this->selected_address['zipcode'],
                'street'          => $this->selected_address['street'],
                'number'          => $this->selected_address['number'],
                'locality'        => $this->selected_address['locality'],
                'state'           => $this->selected_address['state'],
                'state_code'      => $this->selected_address['state_code'] ?? null,
                'floor'           => $this->floor,
                'apartment'       => $this->apartment,
                'office'          => $this->office,
                'details'         => $this->details,
                'lat'             => $this->selected_address['coordinates']['lat'],
                'lng'             => $this->selected_address['coordinates']['lng'],
                'map_url'         => $this->selected_address['map_url'],
                'google_place_id' => $this->selected_address['place_id']
            ]);

            if (Auth::guest())
            {
                session()->push('guest_customer.addresses', $newAddress);
            }

            $this->reset();

            $this->dispatch('new-address-created', $newAddress->id);

            $this->dispatch('close-new-address-panel');

            $this->notify([
                'type'  => 'success',
                'title' => 'Dirección creada con éxito'
            ]);

        } catch (\Throwable $err) 
        {
            Log::channel('error')->error('Error al crear dirección', [
                'message'   => $err->getMessage(),
                'searched'  => $this->search,
                'selected_address' => $this->selected_address
            ]);

            $this->notify([
                'type'  => 'danger',
                'title' => 'Error al crear la dirección',
                'body'  => 'Por favor intentelo de nuevo más tarde'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.ecommerce.new-address-panel');
    }
}
