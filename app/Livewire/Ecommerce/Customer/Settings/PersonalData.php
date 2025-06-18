<?php

namespace App\Livewire\Ecommerce\Customer\Settings;

use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PersonalData extends Component
{
    use WithNotifications;

    #[Validate('required|max:25', as: 'nombre')]
    public $name;

    #[Validate('required|max:30', as: 'apellido')]
    public $lastname;

    #[Validate('required|numeric|min:1000000|max:999999999', as: 'dni')]
    public $document;

    #[Validate('required|size:10', as: 'telefono')]
    public $phone;

    public function mount()
    {
        $this->fill([
            'name'     => Auth::user()->name,
            'lastname' => Auth::user()->lastname,
            'document' => Auth::user()->document,
            'phone'    => Auth::user()->phone
        ]);
    }

    public function update()
    {
        $this->validate();

        Auth::user()->update([
            'name'     => $this->name,
            'lastname' => $this->lastname,
            'document' => $this->document,
            'phone'    => $this->phone
        ]);

        $this->notify([
            'type'  => 'success',
            'title' => 'Información actualizada',
            'body'  => 'Actualizaste correctamente tu información personal'
        ]);

        $this->dispatch('close-edit-information');
    }

    public function render()
    {
        return view('livewire.ecommerce.customer.settings.personal-data');
    }
}
