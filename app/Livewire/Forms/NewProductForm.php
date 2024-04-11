<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class NewProductForm extends Form
{
    #[Validate('required|min:3|max:40', as: 'nombre')]
    public $name;

    #[Validate('nullable|string', as: 'código')]
    public $code;

    #[Validate('required|exists:categories,id', as: 'categoría')]
    public $category_id;

    #[Validate('nullable|string|max:100', as: 'descripción breve')]
    public $short_description;

    #[Validate('nullable|string|max:700', as: 'descripción')]
    public $description;

    #[Validate('required|numeric|max:99999999|not_in:0', as: 'precio')]
    public $price;

    #[Validate('nullable|numeric|integer|max:100|not_in:0', as: 'descuento')]
    public $discount_percent;

    #[Validate('nullable|numeric|integer|not_in:0', as: 'compra mínima')]
    public $min_selling = 1;

    #[Validate('nullable|numeric|integer|not_in:0', as: 'compra máxima')]
    public $max_selling;

    #[Validate('required|numeric|integer')]
    public $stock = 0;

    #[Validate('required|numeric|not_in:0', as: 'peso')]
    public $weight;

    #[Validate('required|integer|exists:operators,id', as: 'peso')]
    public $created_by;

    #[Validate('required|numeric|not_in:0', as: 'ancho')]
    public $width;

    #[Validate('required|numeric|not_in:0', as: 'alto')]
    public $height;

    #[Validate('required|numeric|not_in:0', as: 'largo')]
    public $length;
}
