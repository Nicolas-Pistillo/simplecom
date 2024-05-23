<?php

namespace App\Livewire\Admin\Attributes;

use App\Models\Attribute;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;

class Upsert extends Component
{
    use WithNotifications;

    public function render()
    {
        return view('livewire.admin.attributes.upsert', [
            'attributes' => Attribute::with('values')->get()
        ]);
    }
}
