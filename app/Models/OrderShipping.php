<?php

namespace App\Models;

use App\Enums\LogisticType;
use App\Enums\ShippingStatusCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShipping extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'logistic_type'   => LogisticType::class,
        'status_code'     => ShippingStatusCode::class,
        'calculated_rate' => 'json',
        'selected_branch' => 'json',
        'meta'            => 'json'
    ];

    public function status()
    {
        return $this->hasOne(ShippingStatus::class, 'code', 'status_code');
    }

    public function userAddress()
    {
        return $this->belongsTo(UserAddress::class);
    }
}
