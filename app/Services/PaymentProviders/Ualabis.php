<?php 

namespace App\Services\PaymentProviders;

use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Enums\PaymentStatusCode;
use App\Interfaces\PaymentGateway;
use App\Models\Order;
use App\Models\OrderFeedItem;
use App\Models\OrderPayment;
use App\Models\PaymentMethod;
use App\Traits\Configurable;
use App\Traits\ManagesPaymentRedirections;
use Exception;
use Illuminate\Support\Facades\Http;

class Ualabis implements PaymentGateway
{
    use Configurable, ManagesPaymentRedirections;

    protected $configuration_keys = ['ualabis_username', 'ualabis_client_id', 'ualabis_client_secret'];

    private $token;

    public function model(): PaymentMethod
    {
        return PaymentMethod::where('code', 'ualabis')->first();
    }

    public function generateToken()
    {
        $url = env('UALABIS_TEST')
                ? 'https://auth.stage.developers.ar.ua.la/v2/api/auth/token'
                : 'https://auth.developers.ar.ua.la/v2/api/auth/token';

        $response = Http::withBody(json_encode([
            'username'         => $this->key('ualabis_username'),
            'client_id'        => $this->key('ualabis_client_id'),
            'client_secret_id' => $this->key('ualabis_client_secret'),
            'grant_type'       => 'client_credentials'
        ]))
        ->post($url)
        ->json();

        if (!isset($response['access_token']))
        {
            throw new Exception('Credenciales de Ualabis incorrectas');
        }

        $this->token = $response['access_token'];
    }

    public function generateCheckout(Order $order)
    {
        $this->generateToken();

        $url = env('UALABIS_TEST')
                ? 'https://checkout.stage.developers.ar.ua.la/v2/api/checkout'
                : 'https://checkout.developers.ar.ua.la/v2/api/checkout';

        $response = Http::withToken($this->token)
                        ->withBody(json_encode([
                            'amount'             => 57,
                            'description'        => "Pedido-$order->code",
                            'callback_fail'      => 'https://google.com',
                            'callback_success'   => 'https://google.com',
                            'notification_url'   => $order->paymentWebhook('ualabis'),
                            'external_reference' => "Pedido-$order->code"
                        ]))
                        ->throw()
                        ->post($url)
                        ->json();

        if (!isset($response['uuid']))
        {
            throw new Exception('Error al generar intención de pago con Ualabis');
        }

        OrderPayment::create([
            'order_id'        => $order->id,
            'provider_id'     => $this->model()->id,
            'status_code'     => PaymentStatusCode::Created,
            'checkout_url'    => data_get($response, 'links.checkout_link'),
            'external_id'     => data_get($response, 'uuid'),
            'external_status' => data_get($response, 'status'),
            'total_paid'      => data_get($response, 'amount'),
            'meta'            => [
                [
                    'name'  => 'Referencia',
                    'value' => data_get($response, 'external_reference')
                ]
            ]
        ]);

        OrderFeedItem::create([
            'order_id'      => $order->id,
            'event'         => OrderFeedEvent::PaymentUpdate,
            'presentation'  => OrderFeedPresentation::Icon,
            'initializator' => $order->user->full_name,
            'action'        => 'inició el pago del pedido con Ualabis',
            'meta'          => [
                'icon_code' => 'credit_card'
            ]
        ]);

        $this->provider_checkout_url = data_get($response, 'links.checkout_link');
    }

    public function getPaymentInfo($uuid)
    {
        $this->generateToken();

        $url = env('UALABIS_TEST')
                ? "https://checkout.stage.developers.ar.ua.la/v2/api/orders/$uuid"
                : "https://checkout.developers.ar.ua.la/v2/api/orders/$uuid";

        return Http::withToken($this->token)->get($url)->json();
    }
}