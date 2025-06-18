<?php

namespace App\Services\PaymentProviders;

use App\Enums\NotificationPresentation;
use App\Enums\OrderFeedEvent;
use App\Enums\PaymentStatus;
use App\Interfaces\PaymentGateway;
use App\Models\Order;
use App\Models\OrderFeedItem;
use App\Models\OrderPayment;
use App\Models\PaymentMethod;
use App\Traits\Configurable;
use App\Traits\ManagesPaymentRedirections;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
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

    foreach ($order->items as $item) {
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
      'line_items'          => $items,
      'mode'                => 'payment',
      'client_reference_id' => "Pedido $order->id",
      'success_url'         => $order->paymentReturn(),
      'cancel_url'          => $order->paymentReturn(),
    ]);

    OrderPayment::create([
      'order_id'        => $order->id,
      'provider_id'     => $this->model()->id,
      'status'          => PaymentStatus::Created,
      'external_status' => $checkout->payment_status,
      'checkout_url'    => $checkout->url,
      'intention_id'    => $checkout->id
    ]);

    OrderFeedItem::create([
      'order_id'      => $order->id,
      'event'         => OrderFeedEvent::PaymentUpdate,
      'presentation'  => NotificationPresentation::Icon,
      'initializator' => $order->user->full_name,
      'action'        => 'inició el pago del pedido con Stripe',
      'meta'          => [
        'icon_code' => 'credit_card'
      ]
    ]);

    $this->provider_checkout_url = $checkout->url;
  }

  public function getPaymentInfo($id)
  {
    $client = new StripeClient($this->key('stripe_secret'));
    return $client->checkout->sessions->retrieve($id);
  }

  public function checkCredentials(Collection $credentials): bool
  {
    $publicKey = $credentials->firstWhere('key', 'stripe_key')['value'];
    $secretKey = $credentials->firstWhere('key', 'stripe_secret')['value'];

    $client = new StripeClient($secretKey);

    try 
    {
      $checkout = $client->checkout->sessions->create([
        'line_items'  => [[
          'quantity'          => 1,
          'price_data'      => [
            'currency'      => 'ars',
            'unit_amount'   => 100000,
            'product_data'  => ['name' => 'Prueba']
          ]
        ]],
        'mode'        => 'payment',
        'success_url' => 'https://google.com',
        'cancel_url'  => 'https://google.com',
      ]);

      if (!isset($checkout->id) || !isset($checkout->url)) return false;

      $webhookUrl = str_replace('http://', 'https://', route('tenant.stripe-webhook', ['tenant' => tenant('name')]));

      $has_webhook = false;

      foreach($client->webhookEndpoints->all()->data as $webhook)
      {
        if ($webhook->url === $webhookUrl) $has_webhook = true;
      }

      if (!$has_webhook)
      {
        $webhook = $client->webhookEndpoints->create([
          'url' => $webhookUrl,
          'enabled_events' => [
              'checkout.session.completed',
              'checkout.session.expired',
              'checkout.session.async_payment_failed',
              'checkout.session.async_payment_succeeded'
          ],
          'connect' => true,
        ]);
      }

      return true;

    } catch (\Throwable $th) 
    {
      Log::channel('error')->info('Error al comprobar credenciales STRIPE', [
        'tenant'   => tenant('name'),
        'operator' => auth()->user()->name,
        'message'  => $th->getMessage()
      ]);

      return false;
    }
  }
}
