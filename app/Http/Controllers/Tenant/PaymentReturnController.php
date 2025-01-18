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
use App\Services\PaymentProviders\MercadoPago;
use Illuminate\Support\Facades\Log;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPRequest;

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

        if (!isset($request->payment_id, $request->status))
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
        }

        if (isset($request->payment_id))
        {
            $paymentData = MercadoPago::getPaymentInfo($request->payment_id);

            dd($paymentData);

            if (!isset($paymentData->id, $paymentData->status)) abort(404);

            if ($paymentData->status === 'approved')
            {
                $order->update(['status_code' => OrderStatusCode::Confirmed]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::Confirmed,
                    'external_id'     => $paymentData->id,
                    'installments'    => $paymentData->installments,
                    'external_status' => $paymentData->status,
                    'platform_tax'    => $paymentData->taxes_amount,
                    'total_paid'      => $paymentData->transaction_details->total_paid_amount
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'MercadoPago',
                    'action'        => 'aprobó el pago',
                    'meta'          => [
                        'icon_code'  => 'credit_score',
                        'icon_color' => 'green'
                    ]
                ]);
            }
        }

        dd("Chequear");
    }

    public function mobbex(Request $request, Order $order)
    {
        dd("llego al return de mobbex", $request->all(), $order);
    }

    public function ualabis(Request $request, Order $order)
    {
        dd("llego al return de ualabis", $request->all(), $order);
    }

    public function stripe(Request $request, Order $order)
    {
        dd("llego al return de stripe", $request->all(), $order);
    }
}
