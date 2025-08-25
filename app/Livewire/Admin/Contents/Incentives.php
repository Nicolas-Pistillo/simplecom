<?php

namespace App\Livewire\Admin\Contents;

use App\Livewire\Forms\IncentiveForm;
use App\Models\Incentive;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Incentives extends Component
{
    use WithNotifications;

    public IncentiveForm $form;

    public function openNew()
    {
        $this->form->reset();
        $this->form->published = true;

        $this->dispatch('open-drawer');
    }

    public function openEdit(Incentive $incentive)
    {
        $this->form->reset();

        $this->form->fill([
            'incentive'   => $incentive,
            'type'        => $incentive->type->value,
            'published'   => (bool) $incentive->published,
            'title'       => $incentive->title,
            'description' => $incentive->description,
        ]);

        $this->dispatch('open-drawer');
    }

    public function toggleActive(Incentive $incentive)
    {
        $incentive->update(['published' => !$incentive->published]);

        $action = $incentive->published ? 'publicado' : 'despublicado';

        $this->notify([
            'type' => 'success',
            'title' => "Incentivo $action correctamente"
        ]);
    }

    public function save()
    {
        $this->form->validate();

        if ($this->form->incentive) 
        {
            $this->form->incentive->update([
                'type'        => $this->form->type,
                'title'       => $this->form->title,
                'description' => $this->form->description,
                'published'   => $this->form->published
            ]);

            $this->notify([
                'type' => 'success',
                'title' => 'Incentivo actualizado correctamente'
            ]);

            $this->dispatch('close-drawer');

            return;
        }

        Incentive::create([
            'type'        => $this->form->type,
            'title'       => $this->form->title,
            'description' => $this->form->description,
            'published'   => $this->form->published,
            'created_by'  => Auth::id()
        ]);

        $this->notify([
            'type' => 'success',
            'title' => 'Incentivo creado correctamente'
        ]);

        $this->dispatch('close-drawer');
    }

    public function render()
    {
        return view('livewire.admin.contents.incentives', [
            'incentives' => Incentive::all()
        ]);
    }
}
