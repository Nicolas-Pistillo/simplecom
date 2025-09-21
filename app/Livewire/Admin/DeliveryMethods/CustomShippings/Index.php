<?php

namespace App\Livewire\Admin\DeliveryMethods\CustomShippings;

use App\Models\CustomShippingMethod;
use App\Models\OriginPoint;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    use WithNotifications;

    public function toggleActiveMethod(CustomShippingMethod $method)
    {
        $method->update(['active' => !$method->active]);

        $this->notify([
            'type' => 'success',
            'title' => 'Método de envío actualizado.',
            'icon' => 'local_shipping',
            'body' => $method->name . ' esta ahora ' . ($method->active ? 'activado' : 'desactivado') . '.',
            'position' => 'bottom-right'
        ]);
    }

    public function delete(CustomShippingMethod $method)
    {
        if (!empty($method->logo_url))
        {
            Storage::delete($method->logo_url);
        }

        $method->delete();

        $this->notify([
            'type' => 'success',
            'title' => 'Método de envío eliminado.',
            'icon' => 'delete',
            'body' => $method->name . ' ha sido eliminado correctamente.',
            'position' => 'bottom-right'
        ]);

        $this->dispatch('close-confirm-delete');
    }

    public function render()
    {
        return view('livewire.admin.delivery-methods.custom-shippings.index', [
            'methods' => CustomShippingMethod::all(),
            'origin_point' => OriginPoint::inUse()
        ]);
    }
}
