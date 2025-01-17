<?php

namespace App\Http\Controllers\Tenant;

use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Enums\OrderStatusCode;
use App\Enums\PaymentStatusCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Log;

class PaymentReturnController extends Controller
{
    public function handler(Request $request, $provider, Order $order)
    {
        $providerModel = PaymentMethod::where('code', $provider)->first();

        if (!$providerModel instanceof PaymentMethod) abort(401);

        Log::channel('payment-returns')->info('Retorno de pago recibido', [
            'tenant'   => tenant('name'),
            'provider' => $provider,
            'payload'  => $request->all()
        ]);

        return $this->{$provider}($request, $order);
    }

    public function mercadopago(Request $request, Order $order)
    {
        $order->load('payment', 'user', 'feed');

        if (!isset($request->payment_id, $status))
        {
            $order->payment->update(['status_code' => PaymentStatusCode::Rejected]);
            $order->update(['status_code' => OrderStatusCode::Cancelled]);

            $order->feed()->create([
                'event'         => OrderFeedEvent::PaymentUpdate,
                'presentation'  => OrderFeedPresentation::Icon,
                'initializator' => 'MercadoPago',
                'action'        => 'rechazó el pago',
                'meta'          => [
                    'icon_code'  => 'cancel',
                    'icon_color' => 'red'
                ]
            ]);

            dd("Fijarse ahi");
        }

        dd($request->all());
        dd($order->payment);
    }

    public function mobbex(Request $request, Order $order)
    {
        dd("llego al webhook de mobbex", $request->all());
    }

    public function ualabis(Request $request, Order $order)
    {
        
    }

    public function stripe(Request $request, Order $order)
    {
        dd("llego al webhook de stripe", $request->all());
    }
}
