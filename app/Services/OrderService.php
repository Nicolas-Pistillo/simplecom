<?php 

namespace App\Services;

use App\Enums\DeliveryType;
use App\Enums\OrderStatus;
use App\Livewire\Forms\CheckoutForm;
use App\Models\Order;
use App\Models\ShippingProvider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderService
{
    public static function createFromCheckout(CheckoutForm $form)
    {
        $userId = Auth::id();
        $shippingProvider = null;
        $shippingCost = 0;

        if ($form->delivery_type === DeliveryType::Shipping && !empty($form->selected_rate))
        {
            $shippingProvider = ShippingProvider::where('code', data_get($form->selected_rate, 'source'))->first();
            $shippingCost = floatval(data_get($form->selected_rate, 'price'));
        }

        $order = Order::create([
            'reference'            => Str::upper(Str::random(3) . '-' . rand(100,999)),
            'user_id'              => $userId,
            'status'               => OrderStatus::Created,
            'delivery_type'        => $form->delivery_type,
            'shipping_cost'        => $shippingCost,
            'shipping_provider_id' => $shippingProvider?->id,
            'payment_method_id'    => $form->selected_payment_method,
            'subtotal'             => floatval(Cart::subtotal()),
            'total'                => floatval(Cart::subtotal() + $shippingCost)
        ]);

        return $order;
    }
}