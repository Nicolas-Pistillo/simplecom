<?php

namespace App\Livewire\Admin\Operators;

use App\Models\Operator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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

    public function openDeleteOperator(Operator $operator)
    {
        $this->operator = $operator;
        $this->dispatch('open-delete-dialog');
    }

    public function deleteOperator()
    {
        $this->operator->delete();
        $this->dispatch('close-delete-dialog');

        $this->notificationMessage = "Eliminaste al operador {$this->operator->name}";
        $this->dispatch('open-notification');

        Log::channel('resources')->info("Operador eliminado", [
            'tenant'      => tenant('name'),
            'operator_id' => Auth::id(),
            'operator_resource' => $this->operator
        ]);
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
        $this->validate([
            'name'      => 'required|string|max:30',
            'role'      => 'required|exists:roles,name',
            'area'      => 'nullable|string|max:35'
        ]);

        // Nuevo operador
        if (!$this->operator)
        {
            $this->validate([
                'email'     => 'required|email|unique:operators,email',
                'password'  => 'required|min:7|confirmed'
            ]);

            $operator = Operator::create([
                'name'     => $this->name,
                'email'    => $this->email,
                'password' => Hash::make($this->password),
                'area'     => !empty($this->area) ? $this->area : null
            ])->assignRole($this->role);
    
            Log::channel('resources')->info('Nuevo operador', [
                'tenant'            => tenant('name'),
                'operator_id'       => Auth::id(),
                'operator_resource' => $operator,
                'password'          => $this->password
            ]);

            $this->resetDrawer();

            $this->notificationMessage = "Nuevo operador creado";
            $this->dispatch('open-notification');

            return $this->dispatch('close-drawer');
        }

        if ($this->email != $this->operator->email)
        {
            $this->validate(['email'  => 'required|email|unique:operators,email']);
        }

        // Editando operador
        $this->operator->update([
            'name'  => $this->name,
            'email' => $this->email,
            'area'  => !empty($this->area) ? $this->area : null
        ]);

        if ($this->role != $this->operator->role)
        {
            $this->operator->syncRoles($this->role);
        }

        Log::channel('resources')->info('Operador actualizado', [
            'tenant'            => tenant('name'),
            'operator_id'       => Auth::id(),
            'operator_resource' => $this->operator
        ]);

        $this->resetDrawer();

        $this->notificationMessage = "Operador actualizado con éxito";
        $this->dispatch('open-notification');
        $this->dispatch('close-drawer');
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
