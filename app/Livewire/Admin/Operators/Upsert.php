<?php

namespace App\Livewire\Admin\Operators;

use App\Models\Operator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Upsert extends Component
{
    public $operator, $name, $email, $password, $repeatPassword, $role;

    public $notificationMessage, $drawerTitle, $roles;

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function openNewOperator()
    {
        $this->drawerTitle = "Nuevo operador";
    }

    public function cancelForm()
    {
        $this->dispatch('close-drawer');
        $this->resetExcept('notificationMessage', 'roles'); 
    }

    public function save()
    {
        $this->dispatch('close-drawer');
    }

    public function render()
    {
        return view('livewire.admin.operators.upsert', [
            'operators' => Operator::where('id', '!=', Auth::id())->get()
        ]);
    }
}
