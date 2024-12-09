<?php

namespace App\Livewire\Ecommerce;

use App\Services\GoogleMaps;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class NewAddressPanel extends Component
{
    public $search;

    public $addresses, $selected_address;

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

    public function render()
    {
        return view('livewire.ecommerce.new-address-panel');
    }
}
