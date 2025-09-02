<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CustomShippingForm extends Form
{
    #[Validate('required|string', as: 'nombre de la opcion')]
    public $name;
}
