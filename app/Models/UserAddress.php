<?php

namespace App\Models;

use App\Traits\HasAddress;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory, HasAddress;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['label', 'zipcode_number', 'summary', 'references'];

    public function getLabelAttribute()
    {
        return !empty(trim($this->tag)) ? $this->tag : 'Sin etiqueta';
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function locality()
    {
        return $this->belongsTo(Locality::class);
    }

    public function getSummaryAttribute()
    {
        return "$this->street $this->number CP {$this->zipcode} {$this->locality->name} {$this->province->name}";
    }
}
