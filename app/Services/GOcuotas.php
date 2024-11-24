<?php 

namespace App\Services;

use App\Enums\PaymentRedirectType;
use App\Interfaces\PaymentGateway;
use App\Traits\Configurable;
use Exception;
use Illuminate\Support\Facades\Http;

class GOcuotas implements PaymentGateway
{
    use Configurable;

    protected $configuration_keys = ['gocuotas_redirect_email', 'gocuotas_redirect_password'];

    public $redirect_type = PaymentRedirectType::ProviderPlatform;
    public $provider_checkout_url;

    private $base_url = 'https://sandbox.gocuotas.com/api_redirect/v1';
    private $token;

    public function generateToken()
    {
        $email = tenant()->configValue('gocuotas_redirect_email');
        $password = tenant()->configValue('gocuotas_redirect_password');

        $response = Http::post("$this->base_url/authentication?email=$email&password=$password")->json();

        $this->token = $response['token'];
    }

    public function generateCheckout($order)
    {
        $this->generateToken();

        $payload = [
            'amount_in_cents'       => 150050,
            'email'                 => 'prueba@gocuotas.com',
            'order_reference_id'    => 'U145P345',
            'phone_number'          => '1140506070',
            'url_success'           => route('payment.return', 'gocuotas'),
            'url_failure'           => route('payment.return', 'gocuotas'),
            'webhook_url'           => route('payment.return', 'gocuotas')
        ];

        $response = Http::withToken($this->token)
                        ->withQueryParameters($payload)
                        ->post("$this->base_url/checkouts")
                        ->json();

        $this->provider_checkout_url = $response['url_init'];
    }
}