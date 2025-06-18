<?php

namespace App\Services;

use App\Models\Operator;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class NotificationService
{
    public static function toOperators(Notification $notification)
    {
        FacadesNotification::send(Operator::all(), $notification);
    }
}