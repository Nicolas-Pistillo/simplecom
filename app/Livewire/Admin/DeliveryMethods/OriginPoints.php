<?php

namespace App\Livewire\Admin\DeliveryMethods;

use App\Livewire\Forms\OriginPointForm;
use App\Models\OriginPoint;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;

class OriginPoints extends Component
{
    use WithNotifications;

    protected $listeners = ['origin-point-created' => '$refresh'];

    public OriginPoint $origin_point;

    public OriginPointForm $form;

    public function activateOriginPoint(OriginPoint $originPoint)
    {
        OriginPoint::where(['in_use' => true])->update(['in_use' => false]);

        $originPoint->update(['in_use' => true]);

        $this->dispatch('origin-point-asigned')->to(Providers::class);

        return $this->notify([
            'title' => 'Punto de orígen modificado',
            'body'  => "Los envíos y cotizaciónes se realizarán desde $originPoint->name"
        ]);
    }

    public function editOriginPoint(OriginPoint $originPoint)
    {
        $this->origin_point = $originPoint;

        $this->form->fillByModel($originPoint);

        $this->dispatch('open-edit-origin-point');
    }

    public function updateOriginPoint()
    {
        $this->origin_point->update($this->form->all());

        $this->reset('origin_point');

        $this->dispatch('close-edit-origin-point');

        $this->notify([
            'type'  => 'success',
            'title' => 'Punto de orígen actualizado correctamente'
        ]);
    }

    public function confirmDeleteOriginPoint(OriginPoint $OriginPoint)
    {
        $this->origin_point = $OriginPoint;
        $this->dispatch('open-confirm-origin-point-deletion');
    }

    public function deleteOriginPoint()
    {
        $this->origin_point->delete();

        $this->notify([
            'type'  => 'success',
            'title' => 'Punto de orígen eliminado',
            'body'  => "Eliminaste el punto {$this->origin_point->name}"
        ]);

        $this->reset('origin_point');

        $this->dispatch('origin-point-deleted')->to(Providers::class);
        $this->dispatch('close-confirm-origin-point-deletion');
    }

    public function render()
    {
        return view('livewire.admin.delivery-methods.origin-points', [
            'origin_points' => OriginPoint::all()
        ]);
    }
}
