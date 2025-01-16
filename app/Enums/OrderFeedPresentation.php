<?php

namespace App\Enums;

enum OrderFeedPresentation: string
{
    case Icon           = 'icon';
    case Image          = 'image';
    case InitialsImage  = 'initials_image';
}