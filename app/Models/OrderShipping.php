<?php

namespace App\Models;

use App\Enums\LogisticType;
use App\Enums\ShippingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShipping extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'logistic_type'   => LogisticType::class,
        'status'          => ShippingStatus::class,
        'calculated_rate' => 'json',
        'selected_branch' => 'json',
        'meta'            => 'json'
    ];

    public function provider()
    {
        return $this->belongsTo(ShippingProvider::class);
    }

    public function userAddress()
    {
        return $this->belongsTo(UserAddress::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function originPoint()
    {
        return $this->belongsTo(OriginPoint::class);
    }

    public function syncStatus()
    {
        return $this->provider->service()->syncStatus($this);
    }
}
