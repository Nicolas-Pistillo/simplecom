<?php

namespace App\Models;

use App\Traits\HasAddress;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OriginPoint extends Model
{
    use HasFactory, HasAddress, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['address', 'zipcode_number', 'references'];

    public static function inUse()
    {
        return OriginPoint::where('in_use', true)->first();
    }
}
