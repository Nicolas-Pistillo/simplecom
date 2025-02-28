<?php 

namespace App\Services\PaymentProviders;

use App\Enums\OrderFeedEvent;
use App\Enums\NotificationPresentation;
use App\Enums\PaymentStatus;
use App\Interfaces\PaymentGateway;
use App\Models\Order;
use App\Models\OrderFeedItem;
use App\Models\OrderPayment;
use App\Models\PaymentMethod;
use App\Traits\Configurable;
use App\Traits\ManagesPaymentRedirections;
use Illuminate\Support\Facades\Http;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class MercadoPago implements PaymentGateway
{
    use Configurable, ManagesPaymentRedirections;

    protected $configuration_keys = ['mp_access_token'];

    const PAYMENT_TYPE_PARSER = [
        'credit_card'      => 'Tarjeta de crédito',
        'debit_card'       => 'Tarjeta de débito',
        'prepaid_card'     => 'Tarjeta prepaga',
        'bank_transfer'    => 'Pix - PSE',
        'atm'              => 'Pago en ATM',
        'ticket'           => 'Ticket de pago en efectivo',
        'digital_currency' => 'Compra con pago sin tarjeta',
        'digital_wallet'   => 'Paypal',
        'crypto_transfer'  => 'Pago con criptos',
        'account_money'    => 'Dinero en cuenta'
    ];

    public function model(): PaymentMethod
    {
        return PaymentMethod::where('code', 'mercadopago')->first();
    }

    public function generateCheckout(Order $order)
    {
        MercadoPagoConfig::setAccessToken($this->key('mp_access_token'));

        $client = new PreferenceClient();

        $items = [];

        foreach($order->items as $item)
        {
            array_push($items, [
                'id'          => $item->id,
                'title'       => $item->name,
                'quantity'    => $item->quantity,
                'unit_price'  => floatval($item->sell_price),
                'picture_url' => $item->product->first_image,
                'description' => $item->product->description,
                'category_id' => $item->category_id
            ]);
        }

        $preferenceData = [
            'auto_return' => 'approved',
            'items' => $items,
            'notification_url' => $order->paymentWebhook(),
            'statement_descriptor' => tenant('ecommerce_name'),
            'external_reference' => "Pedido $order->id",
            'payer'     => [
                'name'    => $order->user->name,
                'surname' => $order->user->lastname,
                'email'   => $order->user->email,
                'identification' => [
                    'type'   => 'DNI',
                    'number' => $order->user->document
                ]
            ],
            'back_urls' => [
                'success' => $order->paymentReturn(),
                'failure' => $order->paymentReturn(),
                'pending' => $order->paymentReturn(),
            ]
        ];

        if ($order->shipping_cost && $order->shipping_cost > 0)
        {
            $preferenceData['shipments'] = [
                'cost' => $order->shipping_cost,
                'mode' => 'not_specified'
            ];
        }

        $preference = $client->create($preferenceData);

        OrderPayment::create([
            'order_id'     => $order->id,
            'checkout_url' => $preference->init_point,
            'intention_id' => $preference->id,
            'status'       => PaymentStatus::Created,
            'provider_id'  => $this->model()->id,
            'meta'         => [
                [
                    'name'  => 'Tipo operacion',
                    'value' => $preference->operation_type
                ]
            ]
        ]);

        OrderFeedItem::create([
            'order_id'      => $order->id,
            'event'         => OrderFeedEvent::PaymentUpdate,
            'presentation'  => NotificationPresentation::Icon,
            'initializator' => $order->user->full_name,
            'action'        => "inició el pago del pedido con MercadoPago",
            'meta'          => [
                'icon_code' => 'credit_card'
            ]
        ]);

        $this->provider_checkout_url = $preference->init_point;
    }

    public static function getPaymentInfo($payment_id)
    {
        return Http::withToken(tenant()->configValue('mp_access_token'))
                    ->get("https://api.mercadopago.com/v1/payments/$payment_id")
                    ->object();
    }
}