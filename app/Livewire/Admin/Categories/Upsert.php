<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;

class Upsert extends Component
{
    public $drawerRef;
    public $category;

    public function render()
    {
        return view('livewire.admin.categories.upsert');
    }
}
