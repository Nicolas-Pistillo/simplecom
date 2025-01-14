<?php

namespace App\Enums;

enum OrderFeedEvent: string
{
    case StatusChange     = 'status_change';
    case Generic          = 'generic';
}