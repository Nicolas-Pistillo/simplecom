<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCollection extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'active', 'image_url'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_collection_items', 'collection_id');
    }
}
