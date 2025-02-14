<?php

namespace App\Livewire\Admin\DeliveryMethods;

use App\Livewire\Forms\CollectionPointForm;
use App\Models\CollectionPoint;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;

class CollectionPoints extends Component
{
    use WithNotifications;

    protected $listeners = ['collection-point-created' => '$refresh'];

    public CollectionPoint $collection_point;

    public CollectionPointForm $form;

    public function activateCollectionPoint(CollectionPoint $collectionPoint)
    {
        CollectionPoint::where(['in_use' => true])->update(['in_use' => false]);

        $collectionPoint->update(['in_use' => true]);

        $this->dispatch('collection-point-asigned')->to(Providers::class);

        return $this->notify([
            'title' => 'Punto de colecta modificado',
            'body'  => "Los envíos y cotizaciónes se realizarán desde $collectionPoint->name"
        ]);
    }

    public function editCollectionPoint(CollectionPoint $collectionPoint)
    {
        $this->collection_point = $collectionPoint;

        $this->form->fillByModel($collectionPoint);

        $this->dispatch('open-edit-collection-point');
    }

    public function updateCollectionPoint()
    {
        $this->collection_point->update($this->form->all());

        $this->reset('collection_point');

        $this->dispatch('close-edit-collection-point');

        $this->notify([
            'type'  => 'success',
            'title' => 'Punto de colecta actualizado correctamente'
        ]);
    }

    public function confirmDeleteCollectionPoint(CollectionPoint $collectionPoint)
    {
        $this->collection_point = $collectionPoint;
        $this->dispatch('open-confirm-collection-point-deletion');
    }

    public function deleteCollectionPoint()
    {
        $this->collection_point->delete();

        $this->notify([
            'type'  => 'success',
            'title' => 'Punto de colecta eliminado',
            'body'  => "Eliminaste el punto {$this->collection_point->name}"
        ]);

        $this->reset('collection_point');

        $this->dispatch('collection-point-deleted')->to(Providers::class);
        $this->dispatch('close-confirm-collection-point-deletion');
    }

    public function render()
    {
        return view('livewire.admin.delivery-methods.collection-points', [
            'collection_points' => CollectionPoint::all()
        ]);
    }
}
