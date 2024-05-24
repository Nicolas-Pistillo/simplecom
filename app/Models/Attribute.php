<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function isDefault()
    {
        return in_array($this->name, ['Color', 'Talle', 'Calzado']);
    }

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function hasValues()
    {
        return $this->values()->count() > 0;
    }
}
