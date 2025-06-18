<?php 

namespace App\Enums;

enum InputType: string
{
    case Text     = 'text';
    case Password = 'password';
    case Email    = 'email';
    case Number   = 'number';
    case Boolean  = 'boolean';
    case Url      = 'url';
    case File     = 'file';
}