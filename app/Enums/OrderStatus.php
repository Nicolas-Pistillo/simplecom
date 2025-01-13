<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Created = 'Creado';
    case Pending = 'Pendiente';
}