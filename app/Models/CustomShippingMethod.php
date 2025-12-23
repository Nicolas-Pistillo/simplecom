<?php

namespace App\Models;

use App\Enums\ShippingZoneType;
use App\Enums\ZipcodeSelectionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CustomShippingMethod extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'shipping_zone_type'     => ShippingZoneType::class,
        'zipcode_selection_type' => ZipcodeSelectionType::class,
        'selected_provinces'     => 'array',
        'excluded_localities'    => 'array',
        'zipcode_ranges'         => 'array',
        'conditions'             => 'array'
    ];

    public function isFree(): bool
    {
        return $this->price == 0;
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('active', true);
    }
}
