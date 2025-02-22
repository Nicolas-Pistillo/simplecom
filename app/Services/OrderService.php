<?php 

namespace App\Services;

use App\Enums\CustomerType;
use App\Enums\DeliveryType;
use App\Enums\OrderStatus;
use App\Livewire\Forms\CheckoutForm;
use App\Enums\ShippingStatus;
use App\Events\OrderCreated;
use App\Models\CollectionPoint;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderShipping;
use App\Models\ShippingProvider;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public static function createFromCheckout(CheckoutForm $form)
    {
        $userId = Auth::id() ?? session('guest_customer.id');

        $orderWithShipping = $form->delivery_type === DeliveryType::Shipping && !empty($form->selected_rate);
        $storePickupId = $form->delivery_type === DeliveryType::Picking ? $form->selected_store_pickup : null;
        $shippingProvider = null;
        $shippingCost = 0;

        if ($orderWithShipping)
        {
            $shippingProvider = ShippingProvider::where('code', data_get($form->selected_rate, 'source'))->first();
            $shippingCost = floatval(data_get($form->selected_rate, 'price'));
        }

        if (Auth::guest())
        {
            $user = User::updateOrCreate(
            ['id' => session('guest_customer.id')],
            [
                'type'                  => CustomerType::Guest,
                'name'                  => session('guest_customer.name'),
                'lastname'              => session('guest_customer.lastname'),
                'email'                 => session('guest_customer.email'),
                'phone'                 => session('guest_customer.phone'),
                'document'              => session('guest_customer.document'),
                'tax_condition'         => session('guest_customer.tax_condition'),
                'invoice_address'       => session('guest_customer.invoice_address'),
                'invoice_social_reason' => session('guest_customer.invoice_social_reason'),
                'invoice_document'      => session('guest_customer.invoice_document')
            ]);

            $userId = $user->id;

            session()->put('guest_customer.id', $userId);

            if (!empty(session('guest_customer.addresses')))
            {
                foreach(session('guest_customer.addresses') as $address)
                {
                    $address->update(['user_id' => $userId]);
                }
            }
        }

        $order = Order::create([
            'user_id'              => $userId,
            'status'               => OrderStatus::Created,
            'delivery_type'        => $form->delivery_type,
            'store_pickup_id'      => $storePickupId,
            'shipping_cost'        => $shippingCost,
            'shipping_provider_id' => $shippingProvider?->id,
            'payment_method_id'    => $form->selected_payment_method,
            'subtotal'             => floatval(Cart::subtotal()),
            'total'                => floatval(Cart::subtotal() + $shippingCost)
        ]);

        foreach(Cart::content() as $item)
        {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_id'   => $item->id,
                'category_id'  => $item->options->category_id,
                'variant_id'   => $item->options->variant_id,
                'name'         => $item->name,
                'quantity'     => $item->qty,
                'unit_cost'    => $item->model->unit_cost,
                'unit_price'   => $item->model->price,
                'sell_price'   => $item->price,
                'discount'     => $item->options->discount,
                'total'        => $item->price * $item->qty
            ]);
        }

        if ($orderWithShipping)
        {
            $branch = session('selected_branch');

            $collectionPoint = CollectionPoint::inUse();

            OrderShipping::create([
                'order_id'              => $order->id,
                'provider_id'           => $shippingProvider->id,
                'collection_point_id'   => $collectionPoint->id,
                'user_address_id'       => session('selected_address.id'),
                'status'                => ShippingStatus::CreationPending,
                'provider_label'        => data_get($form->selected_rate, 'label'),
                'provider_carrier'      => data_get($form->selected_rate, 'carrier_name'),
                'provider_carrier_code' => data_get($form->selected_rate, 'carrier_code'),
                'provider_carrier_logo' => data_get($form->selected_rate, 'carrier_logo'),
                'provider_service'      => data_get($form->selected_rate, 'service_name'),
                'provider_service_code' => data_get($form->selected_rate, 'service_code'),
                'logistic_type'         => data_get($form->selected_rate, 'logistic_type'),
                'quoted_price'          => data_get($form->selected_rate, 'price'),
                'delivery_estimate'     => data_get($form->selected_rate, 'estimate'),
                'selected_branch'       => !empty($branch) ? $branch : null,
                'selected_branch_id'    => data_get($branch, 'external_id'),
                'calculated_rate'       => $form->selected_rate
            ]);
        }

        OrderCreated::dispatch($order);

        return $order;
    }

    public static function calculatePackage(Order $order)
    {
        $order->load('items');

        $declaredValue = floatval($order->items->sum(fn($item) => $item->unit_price * $item->quantity));
        $width  = floatval($order->items->max('product.width'));
        $height = floatval($order->items->sum(fn($item) => $item->product->height * $item->quantity));
        $length = floatval($order->items->max('product.length'));
        $weight = floatval($order->items->sum(fn($item) => ($item->product->weight / 1000) * $item->quantity));

        $package = [
            'items' => $order->items->sum('quantity'),
            'weight' => $weight,
            'declaredValue' => $declaredValue,
            'dimensions' => [
                'width'  => $width,
                'height' => $height,
                'length' => $length,
                'volume' => $width * $height * $length
            ]
        ];

        return $package;
    }
}