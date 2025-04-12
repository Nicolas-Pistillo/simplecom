<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class IndexProductsFilters extends Form
{
    #[Validate('nullable|exists:categories,id', as: 'categoría')]
    public $category_id;

    #[Validate('nullable|exists:brands,id', as: 'categoría')]
    public $brand_id;

    #[Validate('nullable|boolean', as: 'publicados')]
    public $only_published;

    #[Validate('nullable|boolean', as: 'destacados')]
    public $only_featured;

    public function isNotEmpty()
    {
        return !empty($this->category_id) || !empty($this->brand_id) 
                || $this->only_published || $this->only_featured;
    }
}
