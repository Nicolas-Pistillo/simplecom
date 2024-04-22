<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'order', 'url'];

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function url()
    {
        return Storage::url($this->url);
    }
}
