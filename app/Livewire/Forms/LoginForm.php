<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|email', as: 'email')]
    public $login_email;

    #[Validate('required', as: 'contraseña')]
    public $login_password;
}
