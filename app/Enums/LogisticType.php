<?php

namespace App\Enums;

enum LogisticType: string
{
    case OriginToDoor     = 'origin_to_door';
    case OriginToDropoff  = 'origin_to_dropoff';
    case DropoffToDoor    = 'dropoff_to_door';
    case DropoffToDropoff = 'dropoff_to_dropoff';
}