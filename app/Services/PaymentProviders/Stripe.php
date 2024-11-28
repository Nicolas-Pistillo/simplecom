<?php 

namespace App\Services\PaymentProviders;

use App\Interfaces\PaymentGateway;
use App\Traits\Configurable;
use App\Traits\ManagesPaymentRedirections;
use Stripe\StripeClient;

class Stripe implements PaymentGateway
{
    use Configurable, ManagesPaymentRedirections;

    protected $configuration_keys = ['stripe_key', 'stripe_secret'];

    public function generateCheckout($order)
    {
        //$stripe_key = tenant()->configValue('stripe_key');
        $stripe_secret = tenant()->configValue('stripe_secret');

        $client = new StripeClient($stripe_secret);

        $checkout = $client->checkout->sessions->create([
            'line_items' => [
              [
                'price' => 'price_1QPxTFCezPFugwa990lFnEjD',
                'quantity' => 1,
              ],
            ],
            'mode' => 'payment',
            'success_url' => route('payment.return', ['provider' => 'stripe']),
            'cancel_url' => route('payment.return', ['provider' => 'stripe']),
          ]);

        $this->provider_checkout_url = $checkout->url;
    }
}