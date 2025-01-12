<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Created = 'Creada';
    case Pending = 'Pendiente';
}