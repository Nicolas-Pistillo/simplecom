<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class NewProductForm extends Form
{
    #[Validate('required|min:3|max:40')]
    public $name;

    #[Validate('nullable|string')]
    public $code;

    #[Validate('required|exists:categories,id')]
    public $category_id;

    #[Validate('nullable|string|max:100')]
    public $short_description;

    protected $validationAttributes = [
        'name'              => 'nombre',
        'code'              => 'código',
        'category_id'       => 'categoría',
        'short_description' => 'descripción breve'
    ];
}
