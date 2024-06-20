<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Configuration;

class Configurations extends Component
{
    public function mount()
    {
        $configs = Configuration::all()->groupBy('topic');
    }

    public function render()
    {
        return view('livewire.admin.configurations');
    }
}
