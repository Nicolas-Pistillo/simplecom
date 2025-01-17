<?php 

namespace App\Services;

use App\Enums\CustomerType;
use App\Enums\DeliveryType;
use App\Enums\OrderFeedEvent;
use App\Enums\OrderStatusCode;
use App\Livewire\Forms\CheckoutForm;
use App\Enums\OrderFeedPresentation;
use App\Enums\ShippingStatusCode;
use App\Models\Order;
use App\Models\OrderFeedItem;
use App\Models\OrderItem;
use App\Models\OrderShipping;
use App\Models\ShippingProvider;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderService
{
    public static function createFromCheckout(CheckoutForm $form)
    {
        $userId = Auth::id();

        $orderWithShipping = $form->delivery_type === DeliveryType::Shipping && !empty($form->selected_rate);
        $shippingProvider = null;
        $shippingCost = 0;

        if ($orderWithShipping)
        {
            $shippingProvider = ShippingProvider::where('code', data_get($form->selected_rate, 'source'))->first();
            $shippingCost = floatval(data_get($form->selected_rate, 'price'));
        }

        if (Auth::guest())
        {
            $user = User::create([
                'type'      => CustomerType::Guest,
                'name'      => session('guest_customer.name'),
                'lastname'  => session('guest_customer.lastname'),
                'email'     => session('guest_customer.email'),
                'phone'     => session('guest_customer.phone'),
                'document'  => session('guest_customer.document')
            ]);

            $userId = $user->id;

            if (!empty(session('guest_customer.addresses')))
            {
                foreach(session('guest_customer.addresses') as $address)
                {
                    $address->update(['user_id' => $userId]);
                }
            }
        }

        $order = Order::create([
            'reference'            => Str::upper(Str::random(3) . '-' . rand(100,999)),
            'user_id'              => $userId,
            'status_code'          => OrderStatusCode::Created,
            'delivery_type'        => $form->delivery_type,
            'shipping_cost'        => $shippingCost,
            'shipping_provider_id' => $shippingProvider?->id,
            'payment_method_id'    => $form->selected_payment_method,
            'subtotal'             => floatval(Cart::subtotal()),
            'total'                => floatval(Cart::subtotal() + $shippingCost)
        ]);

        OrderFeedItem::create([
            'order_id'      => $order->id,
            'event'         => OrderFeedEvent::PaymentUpdate,
            'presentation'  => OrderFeedPresentation::InitialsImage,
            'initializator' => Auth::check() ? Auth::user()->full_name : $user->full_name,
            'action'        => 'realizó este pedido'
        ]);

        foreach(Cart::content() as $item)
        {
            OrderItem::create([
                'order_id'    => $order->id,
                'product_id'  => $item->id,
                'category_id' => $item->model->category_id,
                'variant_id'  => $item->options->variant_id,
                'name'        => $item->name,
                'quantity'    => $item->qty,
                'unit_cost'   => $item->model->unit_cost,
                'unit_price'  => $item->price,
                'total'       => $item->price * $item->qty
            ]);
        }

        if ($orderWithShipping)
        {
            $branch = session('selected_branch');

            OrderShipping::create([
                'order_id'          => $order->id,
                'provider_id'       => $shippingProvider->id,
                'status_code'       => ShippingStatusCode::CreationPending,
                'provider_label'    => data_get($form->selected_rate, 'label'),
                'provider_service'  => data_get($form->selected_rate, 'service_name'),
                'provider_carrier'  => data_get($form->selected_rate, 'carrier_name'),
                'logistic_type'     => data_get($form->selected_rate, 'logistic_type'),
                'price'             => data_get($form->selected_rate, 'price'),
                'delivery_estimate' => data_get($form->selected_rate, 'estimate'),
                'selected_branch'   => !empty($branch) ? $branch : null,
                'calculated_rate'   => $form->selected_rate
            ]);
        }

        return $order;
    }
}