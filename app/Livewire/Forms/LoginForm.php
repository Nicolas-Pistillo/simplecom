<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|email', as: 'email')]
    public $email;

    #[Validate('required|min:8', as: 'contraseña')]
    public $password;

    #[Validate('required|boolean', as: 'recordar sesion')]
    public $remember = false;
}
