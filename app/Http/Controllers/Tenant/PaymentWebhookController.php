<?php

namespace App\Http\Controllers\Tenant;

use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Enums\OrderStatusCode;
use App\Enums\PaymentStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Tenant;
use App\Services\PaymentProviders\MercadoPago;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentWebhookController extends Controller
{
    public function handler($tenant, $order, $provider, Request $request)
    {
        $tenantModel = Tenant::find($tenant);

        if (!$tenantModel instanceof Tenant) abort(401, 'tenant does not exist');

        tenancy()->initialize($tenant);

        $order = Order::find($order);

        if (!$order || !$order instanceof Order) abort(401, 'order does not exist');

        $providerModel = PaymentMethod::where('code', $provider)->first();

        if (!$providerModel || !$order instanceof PaymentMethod) abort(401, 'provider does not exist');

        return $this->{$provider}($request, $order);
    }

    public function mercadopago(Request $request, Order $order)
    {
        if (isset($request->topic) && $request->topic === 'payment')
        {
            $payment = MercadoPago::getPaymentInfo($request->id);

            if (!$payment || !isset($payment->id)) abort(401, 'payment does not exist');

            $paymentOrderCode = str_replace('Pedido ', '', $payment->external_reference);

            if ($order->code != $paymentOrderCode) abort(401, 'Target order does not match');

            Log::channel('webhooks')->info('Actualización de pago recibida', [
                'proveedor' => 'mercadopago',
                'tenant'    => tenant('name'),
                'pedido'    => $order->code,
                'payload'   => $payment
            ]);

            if ($payment->status === 'approved' && $order->payment->status_code != PaymentStatusCode::Confirmed)
            {
                $order->update(['status_code' => OrderStatusCode::Confirmed]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::Confirmed,
                    'external_id'     => $payment->id,
                    'instrument'      => MercadoPago::PAYMENT_TYPE_PARSER[$payment->payment_type_id],
                    'installments'    => $payment->installments,
                    'external_status' => $payment->status,
                    'platform_tax'    => $payment->taxes_amount,
                    'total_paid'      => $payment->transaction_details->total_paid_amount
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

            if ($payment->status === 'pending' && $order->payment->status_code != PaymentStatusCode::Pending)
            {
                $order->update(['status_code' => OrderStatusCode::PaymentPending]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::Pending,
                    'external_id'     => $payment->id,
                    'instrument'      => MercadoPago::PAYMENT_TYPE_PARSER[$payment->payment_type_id],
                    'installments'    => $payment->installments,
                    'external_status' => $payment->status,
                    'platform_tax'    => $payment->taxes_amount,
                    'total_paid'      => $payment->transaction_details->total_paid_amount
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'MercadoPago',
                    'action'        => 'está esperando el pago del comprador',
                    'meta'          => [
                        'icon_code'  => 'credit_card_clock',
                        'icon_color' => 'orange'
                    ]
                ]);
            }

            if ($payment->status === 'authorized' && $order->payment->status_code != PaymentStatusCode::Authorized)
            {
                $order->update(['status_code' => OrderStatusCode::Confirmed]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::Authorized,
                    'external_id'     => $payment->id,
                    'instrument'      => MercadoPago::PAYMENT_TYPE_PARSER[$payment->payment_type_id],
                    'installments'    => $payment->installments,
                    'external_status' => $payment->status,
                    'platform_tax'    => $payment->taxes_amount,
                    'total_paid'      => $payment->transaction_details->total_paid_amount
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'MercadoPago',
                    'action'        => 'autorizó el pago pero aún no lo ha capturado',
                    'meta'          => [
                        'icon_code'  => 'credit_score',
                        'icon_color' => 'lime'
                    ]
                ]);
            }

            if ($payment->status === 'rejected' && $order->payment->status_code != PaymentStatusCode::Rejected)
            {
                $order->update(['status_code' => OrderStatusCode::PaymentRejected]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::Rejected,
                    'external_id'     => $payment->id,
                    'instrument'      => MercadoPago::PAYMENT_TYPE_PARSER[$payment->payment_type_id],
                    'installments'    => $payment->installments,
                    'external_status' => $payment->status,
                    'platform_tax'    => $payment->taxes_amount,
                    'total_paid'      => $payment->transaction_details->total_paid_amount
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'MercadoPago',
                    'action'        => 'rechazó un intento de pago, el comprador puede reintentar la compra',
                    'meta'          => [
                        'icon_code'  => 'credit_card_off',
                        'icon_color' => 'red'
                    ]
                ]);
            }

            if ($payment->status === 'in_process' && $order->payment->status_code != PaymentStatusCode::InRevision)
            {
                $order->update(['status_code' => OrderStatusCode::ProviderPayPending]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::InRevision,
                    'external_id'     => $payment->id,
                    'instrument'      => MercadoPago::PAYMENT_TYPE_PARSER[$payment->payment_type_id],
                    'installments'    => $payment->installments,
                    'external_status' => $payment->status,
                    'platform_tax'    => $payment->taxes_amount,
                    'total_paid'      => $payment->transaction_details->total_paid_amount
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'MercadoPago',
                    'action'        => 'está revisando el pago, se esperan actualizaciónes de estado',
                    'meta'          => [
                        'icon_code'  => 'credit_card_clock',
                        'icon_color' => 'orange'
                    ]
                ]);
            }

            if ($payment->status === 'cancelled' && $order->payment->status_code != PaymentStatusCode::Cancelled)
            {
                $order->update(['status_code' => OrderStatusCode::PaymentCancelled]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::Cancelled,
                    'external_id'     => $payment->id,
                    'instrument'      => MercadoPago::PAYMENT_TYPE_PARSER[$payment->payment_type_id],
                    'installments'    => $payment->installments,
                    'external_status' => $payment->status,
                    'platform_tax'    => $payment->taxes_amount,
                    'total_paid'      => $payment->transaction_details->total_paid_amount
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'MercadoPago',
                    'action'        => 'canceló o caducó el pago del pedido, la compra queda rechazada',
                    'meta'          => [
                        'icon_code'  => 'cancel',
                        'icon_color' => 'red'
                    ]
                ]);
            }

            if ($payment->status === 'in_mediation' && $order->payment->status_code != PaymentStatusCode::ProviderClaimed)
            {
                $order->update(['status_code' => OrderStatusCode::ProviderPayClaimed]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::ProviderClaimed,
                    'external_id'     => $payment->id,
                    'instrument'      => MercadoPago::PAYMENT_TYPE_PARSER[$payment->payment_type_id],
                    'installments'    => $payment->installments,
                    'external_status' => $payment->status,
                    'platform_tax'    => $payment->taxes_amount,
                    'total_paid'      => $payment->transaction_details->total_paid_amount
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'MercadoPago',
                    'action'        => 'informó que el comprador inició una disputa por este pago',
                    'meta'          => [
                        'icon_code'  => 'checkbook',
                        'icon_color' => 'orange'
                    ]
                ]);
            }

            if ($payment->status === 'refunded' && $order->payment->status_code != PaymentStatusCode::Refunded)
            {
                $order->update(['status_code' => OrderStatusCode::Refunded]);

                $order->payment->update([
                    'status_code'     => PaymentStatusCode::Refunded,
                    'external_id'     => $payment->id,
                    'instrument'      => MercadoPago::PAYMENT_TYPE_PARSER[$payment->payment_type_id],
                    'installments'    => $payment->installments,
                    'external_status' => $payment->status,
                    'platform_tax'    => $payment->taxes_amount,
                    'total_paid'      => $payment->transaction_details->total_paid_amount
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => OrderFeedPresentation::Icon,
                    'initializator' => 'MercadoPago',
                    'action'        => 'confirmó el reembolso de este pago',
                    'meta'          => [
                        'icon_code'  => 'currency_exchange',
                        'icon_color' => 'blue'
                    ]
                ]);
            }

            $order->payment->update([
                'meta' => [
                    [
                        'name'  => 'Tipo operación',
                        'value' => $payment->operation_type
                    ],
                    [
                        'name'  => 'Código estado',
                        'value' => $payment->status_detail
                    ],
                    [
                        'name'  => 'Ultima actualización',
                        'value' => Carbon::parse($payment->date_last_updated)->format('d/m/Y H:i:s')
                    ],
                    [
                        'name'  => 'ID colector',
                        'value' => $payment->collector_id
                    ],
                    [
                        'name'  => 'ID orden',
                        'value' => $payment->order->id
                    ],
                    [
                        'name'  => 'Recurso externo',
                        'value' => $payment->transaction_details->external_resource_url,
                        'type'  => 'link'
                    ]
                ]
            ]);
        }
    }

    public function mobbex(Request $request, Order $order)
    {
        Log::channel('webhooks')->info('Webhook de Mobbex recibido', [
            'data' => $request->all()
        ]);

        return response()->json(['success' => true, 'message' => 'Llego al webhook de mobbex']);
    }
}
