<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\DeliveryType;
use App\Enums\PaymentStatus;
use App\Enums\ShippingStatus;
use App\Livewire\Forms\IndexOrdersFilters;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'status'        => OrderStatus::class,
        'delivery_type' => DeliveryType::class
    ];

    protected $appends = ['total_items'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTotalItemsAttribute()
    {
        return $this->items()->sum('quantity');
    }

    public function is_confirmed(): bool
    {
        return  $this->status === OrderStatus::Confirmed || 
                $this->status === OrderStatus::Delivered || 
                $this->status === OrderStatus::PickupReady ||
                in_array($this->payment?->status, [PaymentStatus::Confirmed, PaymentStatus::Authorized]);
    }

    public function was_dispatched(): bool
    {
        return  in_array($this->status, [OrderStatus::Dispatched, OrderStatus::InTransit, OrderStatus::Delivered]) ||
                in_array($this->shipping->status, [ShippingStatus::Dispatched, ShippingStatus::InTransit, ShippingStatus::Delivered]);
    }

    public function was_instransit(): bool
    {
        return  in_array($this->status, [OrderStatus::InTransit, OrderStatus::Delivered]) ||
                in_array($this->shipping->status, [
                    ShippingStatus::InTransit, 
                    ShippingStatus::Delivered,
                    ShippingStatus::DeliveryNear,
                    ShippingStatus::LastTrace
                ]);
    }

    public function is_delivered(): bool
    {
        return  $this->status === OrderStatus::Delivered ||
                $this->shipping->status === ShippingStatus::Delivered;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function feed()
    {
        return $this->hasMany(OrderFeedItem::class);
    }

    public function payment()
    {
        return $this->hasOne(OrderPayment::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function shipping()
    {
        return $this->hasOne(OrderShipping::class);
    }

    public function shippingProvider()
    {
        return $this->belongsTo(ShippingProvider::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function storePickup()
    {
        return $this->belongsTo(StorePickup::class);
    }

    public function detailPage()
    {
        return route('admin.orders.show', $this->id);
    }

    public function customerDetailPage()
    {
        return route('customer.orders.show', $this->id);
    }

    public function discountStock()
    {
        if ($this->stock_discounted) return;

        foreach($this->items as $item)
        {
            $item->variant ? $item->variant->update(['stock' => ($item->variant->stock - $item->quantity)])
                           : $item->product->update(['stock' => ($item->product->stock - $item->quantity)]);

            if ($item->variant)
                $item->product->update(['stock' => intval($item->product->variants()->sum('stock'))]);
        }

        $this->update(['stock_discounted' => true]);
    }

    public function paymentReturn()
    {
        return route('payment.return', [
            'provider' => $this->paymentMethod->code, 
            'order'    => $this->id
        ]);
    }

    public function paymentWebhook()
    {
        $route = route('tenant.payment-webhook', [
            'tenant'   => tenant('name'),
            'order'    => $this->id,
            'provider' => $this->paymentMethod->code
        ]);

        return str_replace('http://', 'https://', $route);
    }

    public function shippingWebhook()
    {
        $route = route('tenant.shipping-webhook', [
            'tenant'        => tenant('name'),
            'orderShipping' => $this->shipping->id,
            'provider'      => $this->shippingProvider->code
        ]);

        return str_replace('http://', 'https://', $route);
    }

    public function getShippingGuide()
    {
        return $this->shippingProvider->service()->getStatus($this->shipping);
    }

    public function scopeAdminSearch(Builder $query, string $search)
    {
        if (!empty(trim($search)))
        {
            $search = stripslashes(trim($search));

            $query->where(function($query) use ($search)
            {
                $query->where('id', 'LIKE', "%$search%");
    
                $query->orWhereHas('user', function($q) use ($search) 
                {
                    $q->where('name', 'LIKE', "%$search%")
                      ->orWhere('lastname', 'LIKE', "%$search%");
                });

                $query->orWhereHas('paymentMethod', function($q) use ($search)
                {
                    $q->where('display_name', 'LIKE', "%$search%")
                        ->orWhere('display_name', 'LIKE', "%$search%")
                        ->orWhere('checkout_name', 'LIKE', "%$search%");
                });

                $query->orWhereHas('shippingProvider', function($q) use ($search)
                {
                    $q->where('code', 'LIKE', "%$search%")
                      ->orWhere('name', 'LIKE', "%$search%");
                });

                $query->orWhereHas('invoice', function($q) use ($search)
                {
                    $q->where('receipt_number', 'LIKE', "%$search%")
                      ->orWhere('cae', 'LIKE', "%$search%");
                });
            });
        }
    }

    public function scopeAdminFilter(Builder $query, IndexOrdersFilters $filters)
    {
        $query->where(function ($query) use ($filters)
        {
            if (!empty($filters->status))
            {
                $query->where('status', $filters->status);
            }

            if (!empty($filters->delivery_type))
            {
                $query->where('delivery_type', $filters->delivery_type);
            }

            if ($filters->only_invoiced)
            {
                $query->where('invoiced', true);
            }
        });
    }
}
