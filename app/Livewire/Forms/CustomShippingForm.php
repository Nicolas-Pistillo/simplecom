<?php

namespace App\Livewire\Forms;

use App\Enums\ShippingZoneType;
use App\Enums\ZipcodeSelectionType;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CustomShippingForm extends Form
{
    #[Validate(as: 'nombre')]
    public $name;

    #[Validate(as: 'tiempo de entrega estimado')]
    public $estimated_delivery;

    #[Validate(as: 'precio')]
    public $price = 0;

    #[Validate(as: 'activo')]
    public $active = true;

    public $logo;

    public $logo_preview;

    #[Validate(as: 'tipo de zona de envío')]
    public $shipping_zone_type = ShippingZoneType::CountryAll->value;

    #[Validate(as: 'provincias')]
    public $selected_provinces = [];

    #[Validate(as: 'localidades excluidas')]
    public $excluded_localities = [];

    #[Validate(as: 'tipo de seleccion - códigos postales')]
    public $zipcode_selection_type = ZipcodeSelectionType::ByRanges->value;

    #[Validate(as: 'rango de códigos postales')]
    public $zipcode_ranges = [['from' => '', 'to'   => '']];

    #[Validate(as: 'lista de códigos postales')]
    public $zipcode_list = '';

    #[Validate(as: 'distancia en km')]
    public $distance_km;

    #[Validate(as: 'condiciones')]
    public $conditions = [];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:80',
            'estimated_delivery' => 'nullable|string|max:300',
            'price' => 'required|numeric|min:0',
            'logo' => 'nullable|file|image|max:4024',
            'shipping_zone_type' => ['required', 'string', new Enum(ShippingZoneType::class)],

            'selected_provinces' => $this->shipping_zone_type === ShippingZoneType::ByLocalities->value
            ? ['required', 'array', 'min:1']
            : ['nullable', 'array'],

            'excluded_localities' => 'nullable|array',
            'zipcode_selection_type' => [
                Rule::requiredIf($this->shipping_zone_type === ShippingZoneType::ByZipcodes->value),
                'string',
                new Enum(ZipcodeSelectionType::class) 
            ],
            'zipcode_ranges' => [
                Rule::requiredIf(
                    $this->shipping_zone_type === ShippingZoneType::ByZipcodes->value && 
                    $this->zipcode_selection_type === ZipcodeSelectionType::ByRanges->value
                ),
                'array',
                'min:1'
            ],
            'zipcode_ranges.*.from' => [
                Rule::requiredIf(
                    $this->shipping_zone_type === ShippingZoneType::ByZipcodes->value && 
                    $this->zipcode_selection_type === ZipcodeSelectionType::ByRanges->value
                ),
                'integer'
            ],
            'zipcode_ranges.*.to' => [
                Rule::requiredIf(
                    $this->shipping_zone_type === ShippingZoneType::ByZipcodes->value && 
                    $this->zipcode_selection_type === ZipcodeSelectionType::ByRanges->value
                ),
                'integer'
            ],
            'zipcode_list' => [
                Rule::requiredIf(
                    $this->shipping_zone_type === ShippingZoneType::ByZipcodes->value && 
                    $this->zipcode_selection_type === ZipcodeSelectionType::FreeSelection->value
                ),
                'string',
                'regex:/^\d+(,\d+)*$/'
            ],
            'distance_km' => [
                'nullable',
                'required_if:shipping_zone_type,'. ShippingZoneType::ByDistanceKm->value,
                'integer',
                'min:1'
            ]
        ];
    }

    protected function messages()
    {
        return [
            'zipcode_ranges.required' => 'Agregue al menos un rango de códigos postales',
            'zipcode_ranges.*.from.required' => 'escriba un código postal',
            'zipcode_ranges.*.to.required' => 'escriba un código postal',
            'zipcode_ranges.*.from.integer' => 'el código postal debe ser numerico',
            'zipcode_ranges.*.to.integer' => 'el código postal debe ser numerico',
        ];
    }
}
