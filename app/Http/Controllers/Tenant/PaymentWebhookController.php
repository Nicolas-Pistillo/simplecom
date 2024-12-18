<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentWebhookController extends Controller
{
    public function handler(Request $request, $provider)
    {
        return $this->{$provider}($request);
    }

    public function nave(Request $request)
    {
        Log::channel('resources')->info("WEBHOOK DE NAVE RECIBIDO EN TENANT", $request->all());
    }
}
