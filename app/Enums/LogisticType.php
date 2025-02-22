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

    public function isFromDropoff(): bool
    {
        return match($this)
        {
            LogisticType::OriginToDoor      => false,
            LogisticType::OriginToDropoff   => false,
            LogisticType::DropoffToDoor     => true,
            LogisticType::DropoffToDropoff  => true
        };
    }

    public function isFromDoor(): bool
    {
        return match($this)
        {
            LogisticType::OriginToDoor      => true,
            LogisticType::OriginToDropoff   => true,
            LogisticType::DropoffToDoor     => false,
            LogisticType::DropoffToDropoff  => false
        };
    }
}