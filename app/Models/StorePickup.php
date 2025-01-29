<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StorePickup extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['address'];

    public function getAddressAttribute()
    {
        $address = "$this->street $this->number - $this->locality";


        if (!empty($this->floor))
        {
            $address .= " | Piso $this->floor";
        }

        if (!empty($this->local))
        {
            $address .= " | Local $this->local";
        }

        return $address;
    }

    public function mapUrl()
    {
        return "https://maps.google.com/?q=$this->lat,$this->lng";
    }
}
