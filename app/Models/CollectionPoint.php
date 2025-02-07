<?php

namespace App\Models;

use App\Traits\HasAddress;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollectionPoint extends Model
{
    use HasFactory, HasAddress, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['address', 'zipcode_number'];

    public static function inUse()
    {
        return CollectionPoint::where('in_use', true)->first();
    }
}
