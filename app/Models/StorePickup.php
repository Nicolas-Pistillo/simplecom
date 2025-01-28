<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorePickup extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['summary'];

    public function getSummaryAttribute()
    {
        $summary = "$this->street $this->number - $this->locality";


        if (!empty($this->floor))
        {
            $summary .= " | Piso: $this->floor";
        }

        if (!empty($this->local))
        {
            $summary .= " | Local: $this->floor";
        }

        return $summary;
    }

    public function mapUrl()
    {
        return "https://maps.google.com/?q=$this->lat,$this->lng";
    }
}
