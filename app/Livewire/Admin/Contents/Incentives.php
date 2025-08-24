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

    public function save()
    {
        $this->form->validate();

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
