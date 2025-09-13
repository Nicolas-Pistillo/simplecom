<?php

namespace App\Models;

use App\Enums\ShippingMethodType;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingProvider extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'type'   => ShippingMethodType::class
    ];

    /**
     * Returns the associated service class for manage the provider logistic logic
     */
    public function service()
    {
        if (!$this->service_class) return null;

        return new $this->service_class();
    }
}
