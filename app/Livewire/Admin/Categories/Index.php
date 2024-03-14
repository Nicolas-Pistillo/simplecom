<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $listeners = ['reRenderParent' => '$refresh'];

    public function render()
    {
        return view('livewire.admin.categories.index', [
            'categories' => Category::principal()->with('childs')->orderBy('name')->paginate(6)
        ]);
    }
}
