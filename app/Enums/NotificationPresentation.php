<?php

namespace App\Enums;

enum NotificationPresentation: string
{
    case Icon           = 'icon';
    case Image          = 'image';
    case InitialsImage  = 'initials_image';
}