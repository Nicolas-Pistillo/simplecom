<?php 

namespace App\Services;

use App\Enums\PaymentRedirectType;
use App\Interfaces\PaymentGateway;
use App\Traits\Configurable;
use Illuminate\Support\Facades\Http;

class GOcuotas implements PaymentGateway
{
    use Configurable;

    protected $configuration_keys = ['gocuotas_api_key'];

    public $redirect_type = PaymentRedirectType::ProviderPlatform;
    public $provider_checkout_url;

    private $base_url = 'https://sandbox.gocuotas.com/api_redirect/v1';
    private $token;

    public function generateToken()
    {
        $api_key = tenant()->configValue('gocuotas_api_key');

        $response = Http::post("$this->base_url/authentication?email=elpalacioonline@gocuotas.com&password=$api_key")->json();

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
            'url_success'           => 'https://elpalaciodelaoportunidad.com/pruebas/gocuotas/url_success.php',
            'url_failure'           => 'https://elpalaciodelaoportunidad.com/pruebas/gocuotas/url_failure.php',
            'webhook_url'           => 'https://elpalaciodelaoportunidad.com/pruebas/gocuotas/url_webhook.php'
        ];

        $response = Http::withToken($this->token)
                        ->withQueryParameters($payload)
                        ->post("$this->base_url/checkouts")
                        ->json();

        $this->provider_checkout_url = $response['url_init'];
    }
}