<?php

namespace App\Livewire\Forms;

use App\Enums\CustomerType;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RegisterForm extends Form
{
    #[Validate('required|min:3|max:16', as: 'nombre')]
    public $name;

    #[Validate('required|min:3|max:20', as: 'apellido')]
    public $lastname;

    /* #[Validate('required|email', as: 'email')] */
    public $email;

    #[Validate(as: 'contraseña')]
    public $password;

    #[Validate('required|same:password', as: 'repetir contraseña')]
    public $password_repeat;

    #[Validate('required|boolean', as: 'newsletter')]
    public $newsletter_check = true;

    public function rules()
    {
        return [
            'email' => [
                'required', 
                'email', 
                Rule::unique('users', 'email')
                    ->where(fn ($query) => 
                        $query->where('type', CustomerType::Registered)
            )],
            'password' => ['required', Password::min(8)->mixedCase()->numbers()]
        ];
    }

    protected function messages()
    {
        return [
            'password.numbers'     => 'La contraseña debe contener al menos un número',
            'password.mixed'       => 'La contraseña debe tener al menos una mayúscula',
            'password_repeat.same' => 'Las contraseñas no coinciden',
            'email.unique'         => 'Ya hay una cuenta asociada a este email'
        ];
    }
}
