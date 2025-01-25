<?php

namespace App\Services\PaymentProviders;

use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Enums\PaymentRedirectType;
use App\Enums\PaymentStatusCode;
use App\Interfaces\PaymentGateway;
use App\Models\Order;
use App\Models\OrderFeedItem;
use App\Models\OrderPayment;
use App\Models\PaymentMethod;
use App\Traits\Configurable;
use Illuminate\Support\Facades\Http;

class Mobbex implements PaymentGateway
{
    use Configurable;

    protected $configuration_keys = ['mobbex_api_key', 'mobbex_access_token'];

    public $redirect_type = PaymentRedirectType::ProviderPlatform;
    public $provider_checkout_url;

    public function model(): PaymentMethod
    {
        return PaymentMethod::where('code', 'mobbex')->first();
    }

    public function generateCheckout(Order $order)
    {
        $checkout = Http::withHeaders([
            'x-api-key'      => $this->key('mobbex_api_key'),
            'x-access-token' => $this->key('mobbex_access_token'),
            'content-type'   => 'application/json'
        ])->withBody(json_encode([
            'total'       => $order->total,
            'description' => "Pedido $order->code",
            'reference'   => md5(uniqid() . time()),
            'currency'    => 'ARS',
            'test'        => true,
            'return_url'  => $order->paymentReturn('mobbex'),
            'webhook'     => $order->paymentWebhook('mobbex'),
            'customer'    => [
                'email' => $order->user->email,
                'name'  => $order->user->full_name,
                'identification' => $order->user->document
            ]
        ]))
        ->throw()
        ->post("https://api.mobbex.com/p/checkout")
        ->collect('data');

        $this->provider_checkout_url = $checkout->get('url');

        OrderPayment::create([
            'order_id'     => $order->id,
            'checkout_url' => $checkout->get('url'),
            'status_code'  => PaymentStatusCode::Created,
            'provider_id'  => $this->model()->id,
            'meta'         => [
                [
                    'name'  => 'UID',
                    'value' => $checkout->get('id')
                ]
            ]
        ]);

        OrderFeedItem::create([
            'order_id'      => $order->id,
            'event'         => OrderFeedEvent::PaymentUpdate,
            'presentation'  => OrderFeedPresentation::Icon,
            'initializator' => $order->user->full_name,
            'action'        => "inició el pago del pedido con Mobbex",
            'meta'          => [
                'icon_code' => 'credit_card'
            ]
        ]);
    }

    public static function getPaymentInfo($payment_id)
    {
        return Http::withHeaders([
            'x-api-key'      => tenant()->configValue('mobbex_api_key'),
            'x-access-token' => tenant()->configValue('mobbex_access_token')
        ])
        ->withBody(json_encode(['id' => $payment_id]))
        ->post('https://api.mobbex.com/2.0/transactions/status')
        ->collect('data');
    }
}