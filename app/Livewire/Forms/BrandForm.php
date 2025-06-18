<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class BrandForm extends Form
{
    #[Validate('required|max:35', as: 'nombre')]
    public $name;

    #[Validate('nullable|max:255', as: 'descripción')]
    public $description;

    #[Validate('nullable|image|max:1024', as: 'imagen')]
    public $image;

    #[Validate('nullable|boolean', as: 'publicado')]
    public $published;

    #[Validate('nullable|boolean', as: 'destacado')]
    public $featured;
}
