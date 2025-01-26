<?php 

namespace App\Services\PaymentProviders;

use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use App\Enums\PaymentStatusCode;
use App\Interfaces\PaymentGateway;
use App\Models\Order;
use App\Models\OrderFeedItem;
use App\Models\OrderPayment;
use App\Traits\Configurable;
use App\Models\PaymentMethod;
use App\Traits\ManagesPaymentRedirections;
use Exception;
use Illuminate\Support\Facades\Http;

class GOcuotas implements PaymentGateway
{
    use Configurable, ManagesPaymentRedirections;

    protected $configuration_keys = ['gocuotas_redirect_email', 'gocuotas_redirect_password'];

    private $base_url = 'https://www.gocuotas.com/api_redirect/v1';
    private $token;

    public function model(): PaymentMethod
    {
        return PaymentMethod::where('code', 'gocuotas')->first();
    }

    public function __construct()
    {
        if (env('GOCUOTAS_TEST'))
        {
            $this->base_url = 'https://sandbox.gocuotas.com/api_redirect/v1';
        }
    }

    public function generateToken()
    {
        $email = $this->key('gocuotas_redirect_email');
        $password = $this->key('gocuotas_redirect_password');

        $response = Http::post("$this->base_url/authentication?email=$email&password=$password")->json();

        if (!isset($response['token']))
        {
            throw new Exception('Crendenciales de GOcuotas incorrectas');
        }

        $this->token = $response['token'];
    }

    public function generateCheckout(Order $order)
    {
        $this->generateToken();

        $payload = [
            'amount_in_cents'       => 180000,
            'email'                 => 'prueba@gocuotas.com',
            'phone_number'          => '1140506070',
            'order_reference_id'    => "Pedido $order->code",
            'url_success'           => $order->paymentReturn('gocuotas'),
            'url_failure'           => $order->paymentReturn('gocuotas'),
            'webhook_url'           => $order->paymentWebhook('gocuotas')
        ];

        $response = Http::withToken($this->token)
                        ->withQueryParameters($payload)
                        ->throw()
                        ->post("$this->base_url/checkouts")
                        ->json();

        OrderPayment::create([
            'order_id'     => $order->id,
            'provider_id'  => $this->model()->id,
            'checkout_url' => data_get($response, 'url_init'),
            'total_paid'   => data_get($response, 'amount_in_cents') / 100,
            'status_code'  => PaymentStatusCode::Created,
            'meta'         => [
                [
                    'name'  => 'Referencia',
                    'value' => data_get($response, 'order_reference_id')
                ]
            ]
        ]);

        OrderFeedItem::create([
            'order_id'      => $order->id,
            'event'         => OrderFeedEvent::PaymentUpdate,
            'presentation'  => OrderFeedPresentation::Icon,
            'initializator' => $order->user->full_name,
            'action'        => "inició el pago del pedido con GOcuotas",
            'meta'          => [
                'icon_code' => 'credit_card'
            ]
        ]);

        $this->provider_checkout_url = data_get($response, 'url_init');
    }

    public function getPaymentInfo($id)
    {
        $this->generateToken();
        return Http::withToken($this->token)->get("$this->base_url/orders/$id")->json();
    }
}