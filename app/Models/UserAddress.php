<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['label', 'zipcode_number', 'summary'];

    public function getLabelAttribute()
    {
        return $this->name ?? 'Sin etiqueta';
    }

    public function getSummaryAttribute()
    {
        return "$this->street $this->number - $this->locality";
    }

    public function getZipcodeNumberAttribute()
    {
        return preg_replace("/[^0-9]/", "", $this->zipcode);
    }
}
