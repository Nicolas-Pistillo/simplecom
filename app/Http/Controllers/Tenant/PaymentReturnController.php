<?php

namespace App\Http\Controllers\Tenant;

use App\Enums\OrderFeedEvent;
use App\Enums\NotificationPresentation;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Services\PaymentProviders\Modo;
use App\Services\PaymentProviders\Nave;
use Gloudemans\Shoppingcart\Facades\Cart;
use Stripe\StripeClient;

class PaymentReturnController extends Controller
{
    public function handler(Request $request, $provider, Order $order)
    {
        $providerModel = PaymentMethod::where('code', $provider)->first();

        if (!$providerModel instanceof PaymentMethod) abort(404);

        $order->load('user', 'items', 'shipping', 'payment');

        if ($order->status != OrderStatus::Created)
        {
            Cart::destroy();

            session()->forget([
                'rates_results', 'selected_address', 'selected_rate', 'selected_branch'
            ]);
        }

        return $this->{$provider}($request, $order);
    }

    public function transfer(Request $request, Order $order)
    {
        return view('ecommerce.checkout-result', compact('order'));
    }

    public function mercadopago(Request $request, Order $order)
    {
        return view('ecommerce.checkout-result', compact('order'));
    }

    public function modo(Request $request, Order $order)
    {
        $modo = new Modo();

        $paymentInfo = $modo->getPaymentInfo($order->payment->intention_id);

        if (!$paymentInfo || !isset($paymentInfo['id'])) abort(404);

        $bankName   = data_get($paymentInfo, 'payment_data.bank_name');
        $issuerName = data_get($paymentInfo, 'payment_data.issuer_name');

        $instrument = "$bankName $issuerName";

        if ($paymentInfo['status'] === 'ACCEPTED' && $order->status != OrderStatus::Confirmed)
        {
            $order->update(['status' => OrderStatus::Confirmed]);

            $order->payment->update([
                'status'     => PaymentStatus::Confirmed,
                'external_id'     => $paymentInfo['payment_id'],
                'external_status' => $paymentInfo['status'],
                'total_paid'      => $paymentInfo['price'],
                'instrument'      => $instrument,
                'installments'    => data_get($paymentInfo, 'payment_data.additional_info.installments.real_quantity', 1)
            ]);

            $order->feed()->create([
                'event'         => OrderFeedEvent::PaymentUpdate,
                'presentation'  => NotificationPresentation::Icon,
                'initializator' => 'MODO',
                'action'        => "aprobó el pago",
                'meta'          => [
                    'icon_code'  => 'credit_score',
                    'icon_color' => 'green'
                ]
            ]);
        }

        if ($paymentInfo['status'] === 'REJECTED' && $order->status != OrderStatus::PaymentCancelled)
        {
            $order->update(['status' => OrderStatus::PaymentCancelled]);

            $order->payment->update([
                'status'          => PaymentStatus::Cancelled,
                'external_id'     => data_get($paymentInfo, 'payment_data.payment_id'),
                'external_status' => $paymentInfo['status'],
                'total_paid'      => $paymentInfo['price'],
                'instrument'      => $instrument,
                'installments'    => data_get($paymentInfo, 'payment_data.additional_info.installments.real_quantity', 1)
            ]);

            $order->feed()->create([
                'event'         => OrderFeedEvent::PaymentUpdate,
                'presentation'  => NotificationPresentation::Icon,
                'initializator' => 'MODO',
                'action'        => "rechazó el pago",
                'meta'          => [
                    'icon_code'  => 'credit_card_off',
                    'icon_color' => 'red'
                ]
            ]);
        }

        $meta = [
            [
                'name'  => 'ID intención externo',
                'value' => data_get($paymentInfo, 'external_intention_id')
            ],
            [
                'name'  => 'Store ID',
                'value' => data_get($paymentInfo, 'store_id')
            ],
            [
                'name'  => 'Store name',
                'value' => data_get($paymentInfo, 'additional_info.store_name')
            ],
            [
                'name'  => 'Token de transacción',
                'value' => data_get($paymentInfo, 'payment_data.transaction_token')
            ],
            [
                'name'  => 'Código de referencia',
                'value' => data_get($paymentInfo, 'payment_data.reference_code')
            ],
            [
                'name'   => 'ID transacción gateway',
                'helper' => 'Es el ID devuelto por el procesador del pago',
                'value'  => data_get($paymentInfo, 'payment_data.gateway_transaction_id')
            ],
            [
                'name'   => 'Ticket',
                'helper' => 'Número de ticket/cupón de la operación de la pasarela de pagos (gateway)',
                'value'  => data_get($paymentInfo, 'payment_data.ticket')
            ],
            [
                'name'   => 'Cod.Aut de tarjeta',
                'helper' => 'Número de autorización correspondiente de la tarjeta utilizada',
                'value'  => data_get($paymentInfo, 'payment_data.card_authorization_code')
            ],
            [
                'name'  => 'Motivo rechazo',
                'value' => data_get($paymentInfo, 'payment_data.operation_error')
            ]
        ];

        $order->payment->update(compact('meta'));

        $order->refresh();
        return response()->view('ecommerce.checkout-result', compact('order'));
    }

    public function mobbex(Request $request, Order $order)
    {
        if ($order->status === OrderStatus::Created)
        {
            $order->update(['status' => OrderStatus::ProviderPayProcessing]);
            $order->payment->update(['status' => PaymentStatus::InProcess]);

            $order->feed()->create([
                'event'         => OrderFeedEvent::PaymentUpdate,
                'presentation'  => NotificationPresentation::Icon,
                'initializator' => 'Mobbex',
                'action'        => 'está procesando el pago, se esperan actualizaciónes de estado',
                'meta'          => [
                    'icon_code'  => 'credit_card_clock',
                    'icon_color' => 'orange'
                ]
            ]);
        }

        return view('ecommerce.checkout-result', compact('order'));
    }

    public function ualabis(Request $request, Order $order)
    {
        return view('ecommerce.checkout-result', compact('order'));
    }

    public function gocuotas(Request $request, Order $order)
    {
        return view('ecommerce.checkout-result', compact('order'));
    }

    public function cajero24(Request $request, Order $order)
    {
        return view('ecommerce.checkout-result', compact('order'));
    }

    public function nave(Request $request, Order $order)
    {
        $service = new Nave();

        $paymentInfo = $service->getPaymentInfo($order->payment->intention_id);

        if (isset($paymentInfo['id']))
        {
            $transaction = data_get($paymentInfo, 'transactions.0');

            $status = data_get($transaction, 'auth_data.status');

            /* dd($transaction, $paymentInfo); */

            $paymentMethod = data_get($transaction, 'payment_method.name');

            $pan = data_get($transaction, 'payment_method.pan');
            $cardType = data_get($transaction, 'payment_method.card_type');

            if (isset($cardType))
            {
                $paymentMethod .= " $cardType";
            }

            if (isset($pan))
            {
                $paymentMethod .= " $pan";
            }

            if ($status === 'APPROVED' && $order->status != OrderStatus::Confirmed)
            {
                $order->update(['status' => OrderStatus::Confirmed]);

                $order->payment->update([
                    'status'          => PaymentStatus::Confirmed,
                    'instrument'      => $paymentMethod,
                    'external_status' => $status,
                    'total_paid'      => data_get($transaction, 'installment_plan.total_amount.value'),
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => NotificationPresentation::Icon,
                    'initializator' => 'Nave',
                    'action'        => 'aprobó el pago',
                    'meta'          => [
                        'icon_code'  => 'credit_score',
                        'icon_color' => 'green'
                    ]
                ]);
            }

            if ($status === 'REJECTED' && $order->status != OrderStatus::PaymentRejected)
            {
                $order->update(['status' => OrderStatus::PaymentRejected]);

                $order->payment->update([
                    'status'          => PaymentStatus::Rejected,
                    'instrument'      => $paymentMethod,
                    'external_status' => $status,
                    'total_paid'      => data_get($transaction, 'installment_plan.total_amount.value'),
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => NotificationPresentation::Icon,
                    'initializator' => 'Nave',
                    'action'        => 'rechazó un intento de pago, el comprador puede reintentar la compra',
                    'meta'          => [
                        'icon_code'  => 'credit_card_off',
                        'icon_color' => 'red'
                    ]
                ]);
            }

            if ($status === 'CANCELLED' && $order->status != OrderStatus::PaymentCancelled)
            {
                $order->update(['status' => OrderStatus::PaymentCancelled]);

                $order->payment->update([
                    'status'     => PaymentStatus::Cancelled,
                    'instrument'      => $paymentMethod,
                    'external_status' => $status,
                    'total_paid'      => data_get($transaction, 'installment_plan.total_amount.value'),
                ]);

                $order->feed()->create([
                    'event'         => OrderFeedEvent::PaymentUpdate,
                    'presentation'  => NotificationPresentation::Icon,
                    'initializator' => 'Nave',
                    'action'        => 'canceló o caducó el pago del pedido, la compra queda rechazada',
                    'meta'          => [
                        'icon_code'  => 'cancel',
                        'icon_color' => 'red'
                    ]
                ]);
            }

            $meta = [
                [
                    'name'  => 'ID pago interno',
                    'value' => data_get($paymentInfo, 'external_payment_id')
                ],
                [
                    'name'  => 'ID pago externo',
                    'value' => data_get($paymentInfo, 'payment_id')
                ],
                [
                    'name'  => 'Intentos de pago',
                    'value' => data_get($paymentInfo, 'payment_attemps')
                ],
                [
                    'name'  => 'Costo financiero',
                    'value' => '$' . data_get($transaction, 'installment_plan.total_financial_cost')
                ],
            ];

            foreach(data_get($transaction, 'installment_plan.installment_amount.components', []) as $component)
            {
                array_push($meta, [
                    'name'  => data_get($component, 'name'),
                    'value' => data_get($component, 'amount.value')
                ]);
            }

            $order->payment->update(compact('meta'));
        }
        
        $order->refresh();
        return view('ecommerce.checkout-result', compact('order'));
    }

    public function sipago(Request $request, Order $order)
    {
        return view('ecommerce.checkout-result', compact('order')); 
    }

    public function stripe(Request $request, Order $order)
    {
        $service = $order->paymentMethod->service();

        $paymentInfo = $service->getPaymentInfo($order->payment->intention_id);

        if ($paymentInfo->payment_status === 'paid' 
        && $order->payment->status != PaymentStatus::Confirmed)
        {
            $order->update(['status' => OrderStatus::Confirmed]);

            $order->payment->update([
                'status'          => PaymentStatus::Confirmed,
                'external_status' => $paymentInfo->payment_status,
                'total_paid'      => $paymentInfo->amount_total / 100
            ]);

            $order->feed()->create([
                'event'         => OrderFeedEvent::PaymentUpdate,
                'presentation'  => NotificationPresentation::Icon,
                'initializator' => 'Stripe',
                'action'        => 'aprobó el pago',
                'meta'          => [
                    'icon_code'  => 'credit_card',
                    'icon_color' => 'green'
                ]
            ]);
        }

        return view('ecommerce.checkout-result', compact('order')); 
    }
}
