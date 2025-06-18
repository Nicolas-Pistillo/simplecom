<?php 

namespace App\Enums;

enum CustomerType: string
{
    case Registered = 'registered';
    case Guest      = 'guest';

    public function name(): string
    {
        return match($this)
        {
            CustomerType::Registered => 'Registrado',
            CustomerType::Guest      => 'Invitado'
        };
    }
    public function color(): string
    {
        return match($this)
        {
            CustomerType::Registered => 'indigo',
            CustomerType::Guest      => 'gray'
        };
    }
}