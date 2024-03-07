<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;

class CategoriesList extends Component
{
    public function render()
    {
        $categories = Category::principal()->with('childs')->orderBy('name')->get();

        return view('livewire.admin.categories-list', compact('categories'));
    }
}
