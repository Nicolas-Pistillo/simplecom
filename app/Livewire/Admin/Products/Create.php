<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Forms\NewProductForm;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public NewProductForm $form;

    #[Validate(['images.*' => 'nullable|image|max:4020'])]
    public $images = [];

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
