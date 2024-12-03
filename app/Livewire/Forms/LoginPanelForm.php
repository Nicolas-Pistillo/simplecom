<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginPanelForm extends Form
{
    #[Validate('required|email', as: 'email')]
    public $login_email;

    #[Validate('required', as: 'contraseña')]
    public $login_password;

    #[Validate('required|min:3|max:16', as: 'nombre')]
    public $register_name;

    #[Validate('required|min:3|max:20', as: 'apellido')]
    public $register_lastname;

    #[Validate('required|email|unique:users,email', as: 'email')]
    public $register_email;

    #[Validate('required|min:8', as: 'contraseña')]
    public $register_password;

    #[Validate('required|same:register_password', as: 'repetir contraseña')]
    public $register_password_repeat;

    protected function messages()
    {
        return [
            'register_password_repeat.same' => 'Las contraseñas no coinciden'
        ];
    }
}
