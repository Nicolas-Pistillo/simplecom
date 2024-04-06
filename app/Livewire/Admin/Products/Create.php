<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Forms\NewProductForm;
use Livewire\Component;
use App\Models\Category;

class Create extends Component
{
    public NewProductForm $form;

    public function save()
    {
        $this->validate();

        dd("Paso toda la validación");
    }

    public function render()
    {
        $categories = Category::principal()->published()->with('childs')->orderBy('name')->get();

        return view('livewire.admin.products.create', compact('categories'));
    }
}
