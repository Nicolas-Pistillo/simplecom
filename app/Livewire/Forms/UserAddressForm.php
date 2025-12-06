<?php

namespace App\Livewire\Forms;

use App\Models\Province;
use App\Models\UserAddress;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserAddressForm extends Form
{
    #[Validate('required|exists:mysql.provinces,id', as: 'provincia')]
    public $province_id;

    #[Validate('required|exists:mysql.localities,id', as: 'localidad')]
    public $locality_id;

    #[Validate('nullable|string|max:100', as: 'etiqueta')]
    public $tag;

    #[Validate('required|string|max:100', as: 'calle')]
    public $street;

    #[Validate('required|string|max:100', as: 'numero')]
    public $number;

    #[Validate('nullable|string|max:100', as: 'piso')]
    public $floor;

    #[Validate('nullable|string|max:100', as: 'departamento')]
    public $apartment;

    #[Validate('nullable|string|max:100', as: 'oficina')]
    public $office;

    #[Validate('required|numeric|max:99999', as: 'código postal')]
    public $zipcode;

    #[Validate('nullable|string|max:255', as: 'detalles')]
    public $details;

    #[Validate('nullable|boolean')]
    public $show_map_confirm = false;

    #[Validate('nullable')]
    public $gmap_data;

    public function autocomplete(?UserAddress $address = null)
    {
        if (!$address || !$address->exists)
        {
            $defaultProvince = Province::with('localities')->where('name', 'Buenos Aires')->first();

            $this->province_id = $defaultProvince->id;
        } else 
        {
            // ...Autocomplete with address data
        }
    }
}
