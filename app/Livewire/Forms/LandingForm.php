<?php

namespace App\Livewire\Forms;

use App\Enums\TaxCondition;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LandingForm extends Form
{
    #[Validate('required|string|min:3|max:40', as: 'nombre de comercio')]
    public $ecommerce_name;

    #[Validate('required|string|min:3|max:40', as: 'razón social')]
    public $social_reason;

    #[Validate('required|cuit', as: 'cuit-cuil')]
    public $invoice_document;

    #[Validate(['required', new Enum(TaxCondition::class)], as: 'condición fiscal')]
    public $tax_condition;

    #[Validate('required|exists:sectors,id', as: 'rubro')]
    public $sector;

    #[Validate('required|string|min:3', as: 'domicilio fiscal')]
    public $invoice_address;

    #[Validate('required|string|max:30', as: 'nombre administrador')]
    public $operator_name;

    #[Validate('required|email', as: 'email administrador')]
    public $operator_email;

    #[Validate('required|numeric', as: 'teléfono de contacto')]
    public $operator_phone;
}
