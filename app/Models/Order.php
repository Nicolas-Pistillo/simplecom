<?php

namespace App\Models;

use App\Enums\OrderStatusCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\DeliveryType;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'status_code'   => OrderStatusCode::class,
        'delivery_type' => DeliveryType::class
    ];

    public function status()
    {
        return $this->hasOne(OrderStatus::class, 'code', 'status_code');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
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

    public function detailPage()
    {
        return route('admin.orders.show', $this->id);
    }

    public function returnUrl($provider)
    {
        return route('payment.return', ['provider' => $provider, 'order' => $this->id]);
    }

    public function paymentWebhook($provider)
    {
        $route = route('tenant.payment-webhook', [
            'tenant'   => tenant('id'),
            'order'    => $this->id,
            'provider' => $provider
        ]);

        return str_replace('http://', 'https://', $route);
    }
}
