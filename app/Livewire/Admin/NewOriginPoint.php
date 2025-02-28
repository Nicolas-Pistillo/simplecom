<?php

namespace App\Livewire\Admin;

use App\Livewire\Admin\DeliveryMethods\Providers;
use App\Models\OriginPoint;
use App\Services\GoogleMaps;
use App\Traits\Livewire\WithNotifications;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class NewOriginPoint extends Component
{
    use WithNotifications;

    public $search;

    public $addresses;
    public $selected_address;

    #[Validate('required|string|max:50', as: 'nombre de punto')]
    public $name;

    #[Validate('required|min:5', as: 'nombre del encargado')]
    public $staff_name;

    #[Validate('required|email', as: 'email')]
    public $staff_email;

    #[Validate('required|size:10', as: 'telefono')]
    public $staff_phone;

    #[Validate('required|numeric|min:1000000|max:999999999', as: 'dni')]
    public $staff_document;

    public $floor, $local, $observations;

    public function messages()
    {
        return [
            'staff_document.min' => 'El dni debe tener al menos 7 digitos',
            'staff_document.max' => 'El dni no puede tener más de 9 dígitos'
        ];
    }

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
            $OriginPoint = OriginPoint::create([
                'name'            => $this->name,
                'in_use'          => empty(OriginPoint::count()) ? true : false,
                'staff_name'      => $this->staff_name,
                'staff_email'     => $this->staff_email,
                'staff_phone'     => $this->staff_phone,
                'staff_document'  => $this->staff_document,
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

            $this->dispatch('origin-point-created', $OriginPoint->id);

            $this->dispatch('close-new-origin-point');

            $this->notify([
                'type'  => 'success',
                'title' => 'Punto de orígen creado con éxito'
            ]);

        } catch (Exception $err) 
        {
            Log::channel('error')->error('Error al crear punto de orígen', [
                'message'          => $err->getMessage(),
                'searched'         => $this->search,
                'selected_address' => $this->selected_address
            ]);

            $this->notify([
                'type'  => 'danger',
                'title' => 'Error al crear el punto de orígen',
                'body'  => 'Por favor intentelo de nuevo más tarde'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.new-origin-point');
    }
}
