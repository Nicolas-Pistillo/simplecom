<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'status'  => PaymentStatus::class,
        'meta'    => 'json'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
