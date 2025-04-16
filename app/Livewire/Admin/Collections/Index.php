<?php

namespace App\Livewire\Admin\Collections;

use App\Models\ProductCollection;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    use WithNotifications;

    public function togglePublished(ProductCollection $collection)
    {
        $collection->update(['active' => !$collection->active]);

        $actionResult = $collection->active ? 'Publicaste' : 'Despublicaste';

        $this->notify([
            'type'  => 'success',
            'title' => "Coleccion actualizada",
            'body'  => "$actionResult la coleccion $collection->name"
        ]);
    }

    public function delete(ProductCollection $collection)
    {
        if ($collection->image_url) Storage::delete($collection->image_url);

        $collection->products()->sync([]);

        $collection->delete();

        $this->dispatch('close-delete-dialog');

        $this->notify([
            'type'  => 'success',
            'title' => 'Coleccion eliminada',
            'body'  => "Se elimino correctamente la coleccion $collection->name"
        ]);
    }

    public function render()
    {
        return view('livewire.admin.collections.index', [
            'collections' => ProductCollection::with('products')->orderBy('name')->get()
        ]);
    }
}
