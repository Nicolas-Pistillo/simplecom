<?php

namespace App\Livewire\Admin;

use App\Models\StorePickup;
use App\Services\GoogleMaps;
use App\Traits\Livewire\WithNotifications;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class NewStorePickupPoint extends Component
{
    use WithNotifications;

    public $search;

    public $addresses;
    public $selected_address;

    #[Validate('required|string|max:50', as: 'nombre')]
    public $name;

    #[Validate('required|string|max:80', as: 'horarios')]
    public $schedule;

    public $floor, $local, $observations;

    public function updatedSearch()
    {
        if (strlen($this->search) <= 4) return;

        $this->addresses = GoogleMaps::autocompleteAddress($this->search);
    }

    public function selectedAddress($placeId)
    {
        $addressInfo = GoogleMaps::getAddressByPlace($placeId);

        if (!$addressInfo)
        {
            return $this->notify([
                'type'  => 'danger',
                'title' => 'Error al obtener la información',
                'body'  => 'Ocurrió un problema al cargar los detalles de esta ubicación, por favor intentelo de nuevo más tarde'
            ]);
        }

        $this->selected_address = (array) $addressInfo;
    }

    public function removeSelectedAddress()
    {
        $this->reset('selected_address');
    }

    public function save()
    {
        $this->validate();

        try 
        {
            $storePickup = StorePickup::create([
                'name'            => $this->name,
                'schedule'        => $this->schedule,
                'zipcode'         => $this->selected_address['zipcode'],
                'street'          => $this->selected_address['street'],
                'number'          => $this->selected_address['number'],
                'locality'        => $this->selected_address['locality'],
                'state'           => $this->selected_address['state'],
                'state_code'      => $this->selected_address['state_code'] ?? null,
                'floor'           => $this->floor,
                'local'           => $this->local,
                'observations'    => $this->observations,
                'lat'             => $this->selected_address['coordinates']['lat'],
                'lng'             => $this->selected_address['coordinates']['lng'],
                'map_url'         => $this->selected_address['google_map_url'],
                'google_place_id' => $this->selected_address['google_place_id'],
                'created_by'      => Auth::id()
            ]);

            $this->reset();

            $this->dispatch('new-store-pickup-created', $storePickup->id);

            $this->dispatch('close-new-store-pickup-panel');

            $this->notify([
                'type'  => 'success',
                'title' => 'Punto de retiro creado con éxito'
            ]);

        } catch (Exception $err) 
        {
            Log::channel('error')->error('Error al crear punto de retiro', [
                'message'          => $err->getMessage(),
                'searched'         => $this->search,
                'selected_address' => $this->selected_address
            ]);

            $this->notify([
                'type'  => 'danger',
                'title' => 'Error al crear el punto de retiro',
                'body'  => 'Por favor intentelo de nuevo más tarde'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.new-store-pickup-point');
    }
}
