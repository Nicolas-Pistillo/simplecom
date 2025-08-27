<?php

namespace App\Livewire\Forms;

use App\Enums\IncentiveType;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class IncentiveForm extends Form
{
    public $incentive;

    #[Validate(['required','string', new Enum(IncentiveType::class)], as: 'tipo')]
    public $type;

    #[Validate('required|string|min:5|max:35', as: 'titulo')]
    public $title;

    #[Validate('required|string|min:5|max:130', as: 'descripcion')]
    public $description;

    #[Validate('required|boolean', as: 'publicado')]
    public $published;

    public function messages()
    {
        return [
            'type.Illuminate\Validation\Rules\Enum' => 'Seleccione un tipo de incentivo válido'
        ];
    }
}
