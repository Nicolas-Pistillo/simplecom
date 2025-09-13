<?php

namespace App\Models;

use App\Enums\ShippingZoneType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomShippingMethod extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'shipping_zone_type'  => ShippingZoneType::class,
        'selected_provinces'  => 'array',
        'excluded_localities' => 'array',
        'zipcode_ranges'      => 'array',
        'conditions'          => 'array'
    ];

    public function isFree(): bool
    {
        return $this->price == 0;
    }
}
