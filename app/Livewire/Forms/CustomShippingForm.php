<?php

namespace App\Livewire\Forms;

use App\Enums\ShippingZoneType;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CustomShippingForm extends Form
{
    #[Validate('required|string', as: 'nombre de la opcion')]
    public $name;

    #[Validate(['required', 'string', new Enum(ShippingZoneType::class)], as: 'tipo de zona de entrega')]
    public $shipping_zone_type = ShippingZoneType::CountryAll->value;

    #[Validate('nullable|array', as: 'provincias')]
    public $selected_provinces = [];

    #[Validate('nullable|array', as: 'localidades')]
    public $excluded_localities = [];
}
