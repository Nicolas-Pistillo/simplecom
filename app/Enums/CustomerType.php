<?php 

namespace App\Enums;

enum CustomerType: string
{
    case Registered = 'registered';
    case Guest = 'guest';
}