<?php

namespace App\Services\PaymentProviders;

use App\Enums\PaymentRedirectType;
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
      $stripe_secret = tenant()->configValue('stripe_secret');

      $client = new StripeClient($stripe_secret);

      $checkout = $client->checkout->sessions->create([
        'line_items' => [
          [
            'quantity' => 2,
            'price_data' => [
              'currency' => 'ars',
              'unit_amount' => 150000,
              'product_data' => [
                'images' => ['https://acdn.mitiendanube.com/stores/002/207/813/products/whatsapp-image-2023-05-30-at-17-32-121-0f48e0907a5c464d1516854788746781-480-0.jpeg'],
                'name' => 'Zapatillas jordan BLue edition red black',
                'description' => 'Las mejores zapatillas del mercadoa ctualmente y un poco mas de texto'
              ]
            ]
          ],
        ],
        'mode' => 'payment',
        'success_url' => route('payment.return', ['provider' => 'stripe']),
        'cancel_url' => route('payment.return', ['provider' => 'stripe']),
      ]);

      $this->provider_checkout_url = $checkout->url;
    }
}
