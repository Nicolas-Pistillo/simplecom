<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $categories = Category::principal()->with('childs')->orderBy('name')->paginate(2);

        return view('livewire.admin.categories.index', compact('categories'));
    }
}
