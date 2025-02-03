<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductFiltersForm extends Form
{
    #[Url(as: 'orden')]
    public $order = 'relevants';

    #[Url(as: 'categoria')]
    public $categoryQuery;

    public $category;
    
    #[Url(as: 'precio_minimo')]
    public $min_price;
    
    #[Url(as: 'precio_maximo')]
    public $max_price;
}
