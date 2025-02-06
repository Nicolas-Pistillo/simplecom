<?php

namespace App\Services\PaymentProviders;

use App\Interfaces\PaymentGateway;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Traits\Configurable;
use App\Traits\ManagesPaymentRedirections;
use Stripe\StripeClient;

class Stripe implements PaymentGateway
{
    use Configurable, ManagesPaymentRedirections;

    protected $configuration_keys = ['stripe_key', 'stripe_secret'];

    public function model(): PaymentMethod
    {
        return PaymentMethod::where('code', 'stripe')->first();
    }

    public function generateCheckout(Order $order)
    {
      $client = new StripeClient($this->key('stripe_secret'));

      $items = [];

      foreach($order->items as $item)
      {
        array_push($items, [
          'quantity'          => $item->quantity,
            'price_data'      => [
              'currency'      => 'ars',
              'unit_amount'   => floatval($item->sell_price) * 100,
              'product_data'  => [
                'images'      => [$item->product->first_image],
                'name'        => $item->name,
                'description' => $item->description ?? 'Sin descripción'
              ]
            ]
        ]);
      }

      if ($order->shipping_cost > 0)
      {
        array_push($items, [
          'quantity'          => 1,
            'price_data'      => [
              'currency'      => 'ars',
              'unit_amount'   => floatval($order->shipping_cost) * 100,
              'product_data'  => ['name' => 'Envío']
            ]
        ]);
      }

      $checkout = $client->checkout->sessions->create([
        'line_items'  => $items,
        'mode'        => 'payment',
        'success_url' => $order->paymentReturn(),
        'cancel_url'  => $order->paymentReturn(),
      ]);

      dd($checkout);

      $this->provider_checkout_url = $checkout->url;
    }
}
