<?php

namespace App\Livewire\Admin\Operators;

use App\Models\Operator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Upsert extends Component
{
    public $operator, $name, $email, $password, $password_confirmation, $role, $area;

    public $notificationMessage, $drawerTitle, $roles;

    protected $validationAttributes = [
        'name'      => 'nombre',
        'email'     => 'email',
        'password'  => 'contraseña',
        'role'      => 'rol'
    ];

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function openNewOperator()
    {
        $this->resetDrawer();

        $this->drawerTitle = "Nuevo operador";

        $this->dispatch('open-drawer');
    }

    public function openEditOperator(Operator $operator)
    {
        $this->fill([
            'operator' => $operator,
            'drawerTitle' => $operator->name,
            'name'     => $operator->name,
            'email'    => $operator->email,
            'password' => $operator->password,
            'password_confirmation' => $operator->password,
            'role'     => $operator->role,
            'area'     => $operator->area
        ]);

        $this->dispatch('open-drawer');
    }

    public function resetDrawer()
    {
        $this->resetExcept('notificationMessage', 'roles', 'drawerTitle'); 
    }

    public function cancelForm()
    {
        $this->resetDrawer(); 
        $this->dispatch('close-drawer');
    }

    public function save()
    {
        // Nuevo operador
        if (!$this->operator)
        {
            $this->validate([
                'name'      => 'required|string|max:30',
                'email'     => 'required|email|unique:operators,email',
                'password'  => 'required|min:7|confirmed',
                'role'      => 'required|exists:roles,name',
                'area'      => 'nullable|string|max:35'
            ]);

            Operator::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'area'  => !empty($this->area) ? $this->area : null
            ])->assignRole($this->role);
    
            $this->resetDrawer();
            return $this->dispatch('close-drawer');
        }

        // Editando operador
        
    }

    public function render()
    {
        return view('livewire.admin.operators.upsert', [
            'operators' => Operator::where('id', '!=', Auth::id())
                                    ->orderBy('name')
                                    ->get()
        ]);
    }
}
