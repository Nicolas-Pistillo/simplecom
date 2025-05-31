<?php

namespace App\Livewire\Admin;

use App\Models\OriginPoint;
use Livewire\Component;

class OriginPointNavbar extends Component
{
    public function render()
    {
        return view('livewire.admin.origin-point-navbar', [
            'originPoints' => OriginPoint::all(),
        ]);
    }
}
