<?php

namespace App\Livewire\Forms;

use App\Enums\CustomerType;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
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

    #[Validate('required|email', as: 'email')]
    public $register_email;

    #[Validate('required|min:8', as: 'contraseña')]
    public $register_password;

    #[Validate('required|same:register_password', as: 'repetir contraseña')]
    public $register_password_repeat;

    #[Validate('required|boolean', as: 'newsletter')]
    public $register_newsletter_check = true;

    public $register_fields = [
        'register_name', 'register_lastname', 'register_email', 'register_password', 
        'register_password_repeat', 'register_newsletter_check'
    ];

    protected function messages()
    {
        return [
            'register_password_repeat.same' => 'Las contraseñas no coinciden'
        ];
    }
}
