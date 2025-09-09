<?php

namespace App\Livewire\Forms;

use App\Enums\ShippingZoneType;
use App\Enums\ZipcodeSelectionType;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CustomShippingForm extends Form
{
    #[Validate('required|string', as: 'nombre de la opcion')]
    public $name;

    #[Validate('nullable|string', as: 'tiempo de entrega estimado')]
    public $estimated_delivery;

    #[Validate('required|numeric|min:0', as: 'precio')]
    public $price = 0;

    #[Validate('nullable|image|max:4024', as: 'logo')]
    public $logo;

    public $logo_preview;

    #[Validate(['required', 'string', new Enum(ShippingZoneType::class)], as: 'tipo de zona de entrega')]
    public $shipping_zone_type = ShippingZoneType::CountryAll->value;

    #[Validate('nullable|array', as: 'provincias seleccionadas')]
    public $selected_provinces = [];

    #[Validate('nullable|array', as: 'localidades excluidas')]
    public $excluded_localities = [];

    #[Validate(['nullable', 'string', new Enum(ZipcodeSelectionType::class)], as: 'tipo de selección')]
    public $zipcode_selection_type = ZipcodeSelectionType::ByRanges->value;

    #[Validate('nullable|array', as: 'códigos postales')]
    public $zipcodes_range = [['from' => '', 'to'   => '']];

    #[Validate('nullable|string', as: 'códigos postales')]
    public $zipcodes = '';

    #[Validate('nullable|numeric|integer', as: 'distancia en KM')]
    public $distance_km;

    #[Validate('nullable|array', as: 'condiciones')]
    public $conditions = [];
}
