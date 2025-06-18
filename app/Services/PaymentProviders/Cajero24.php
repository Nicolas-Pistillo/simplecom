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
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class Cajero24 implements PaymentGateway
{
    use Configurable, ManagesPaymentRedirections;

    protected $configuration_keys = ['cajero24_token'];

    public function model(): PaymentMethod
    {
        return PaymentMethod::where('code', 'cajero24')->first();
    }

    public function generateCheckout(Order $order)
    {
        $items = [];

        foreach($order->items as $item)
        {
            array_push($items, [
                'name'               => $item->name,
                'external_reference' => $item->id,
                'amount'             => $item->total
            ]);
        }

        if ($order->shipping_cost > 0)
        {
            array_push($items, [
                'name'               => 'Envío',
                'external_reference' => 'envio',
                'amount'             => $order->shipping_cost
            ]);
        }

        $response = Http::withBody(json_encode([
            'access_token'       => $this->key('cajero24_token'),
            'currency'           => 'ARS',
            'external_reference' => "Pedido $order->id",
            'url_success'        => $order->paymentReturn(),
            'url_pending'        => $order->paymentReturn(),
            'url_failure'        => $order->paymentReturn(),
            'ipn'                => $order->paymentWebhook(),
            'items'              => $items
        ]))
        ->throw()
        ->post('https://cajero24.co/api/pay/create')
        ->json();

        OrderPayment::create([
            'order_id'     => $order->id,
            'provider_id'  => $this->model()->id,
            'checkout_url' => data_get($response, 'link'),
            'status'       => PaymentStatus::Created
        ]);

        OrderFeedItem::create([
            'order_id'      => $order->id,
            'event'         => OrderFeedEvent::PaymentUpdate,
            'presentation'  => NotificationPresentation::Icon,
            'initializator' => $order->user->full_name,
            'action'        => "inició el pago del pedido con Cajero24",
            'meta'          => [
                'icon_code' => 'credit_card'
            ]
        ]);

        $this->provider_checkout_url = data_get($response, 'link');
    }

    public function checkCredentials(Collection $credentials): bool
    {
        $token = $credentials->firstWhere('key', 'cajero24_token')['value'];

        $response = Http::withBody(json_encode([
            'access_token'       => $token,
            'currency'           => 'ARS',
            'external_reference' => "Chequeo de servicio",
            'url_success'        => 'https://google.com',
            'url_pending'        => 'https://google.com',
            'url_failure'        => 'https://google.com',
            'ipn'                => 'https://google.com',
            'items'              => [
                [
                    'name'               => 'Prueba',
                    'external_reference' => uniqid(),
                    'amount'             => 10
                ]
            ]
        ]))
        ->post('https://cajero24.co/api/pay/create')
        ->json();

        return isset($response['status'], $response['link']) && $response['status'] === 'success';
    }
}