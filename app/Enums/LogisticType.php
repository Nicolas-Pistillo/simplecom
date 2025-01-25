<?php

namespace App\Enums;

enum LogisticType: string
{
    case OriginToDoor     = 'origin_to_door';
    case OriginToDropoff  = 'origin_to_dropoff';
    case DropoffToDoor    = 'dropoff_to_door';
    case DropoffToDropoff = 'dropoff_to_dropoff';

    public function name(): string
    {
        return match($this)
        {
            LogisticType::OriginToDoor      => 'Puerta a puerta',
            LogisticType::OriginToDropoff   => 'Puerta a sucursal',
            LogisticType::DropoffToDoor     => 'Sucursal a puerta',
            LogisticType::DropoffToDropoff  => 'Sucursal a sucursal'
        };
    }
}