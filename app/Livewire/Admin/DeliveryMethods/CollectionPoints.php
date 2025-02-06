<?php

namespace App\Livewire\Admin\DeliveryMethods;

use App\Models\CollectionPoint;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;

class CollectionPoints extends Component
{
    use WithNotifications;

    protected $listeners = ['new-collection-point-created' => '$refresh'];

    public function render()
    {
        return view('livewire.admin.delivery-methods.collection-points', [
            'collection_points' => CollectionPoint::all()
        ]);
    }
}
