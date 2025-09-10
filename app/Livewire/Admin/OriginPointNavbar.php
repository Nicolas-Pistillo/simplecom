<?php

namespace App\Livewire\Admin;

use App\Models\OriginPoint;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;

class OriginPointNavbar extends Component
{
    use WithNotifications;

    protected $listeners = ['origin-point-created' => '$refresh'];

    public function setActive(OriginPoint $originPoint)
    {
        OriginPoint::where(['in_use' => true])->update(['in_use' => false]);

        $originPoint->update(['in_use' => true]);

        $this->notify([
            'type'  => 'success',
            'icon'  => 'local_shipping',
            'title' => 'Punto de origen modificado',
            'body'  => "Ahora los envíos y despachos se realizarán desde $originPoint->name",
            'position' => 'bottom-right',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.origin-point-navbar', [
            'originPoints' => OriginPoint::all(),
        ]);
    }
}
