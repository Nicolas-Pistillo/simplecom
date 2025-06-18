<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductCollection extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'active', 'image_url'];

    public function editPage()
    {
        return route('admin.collections.edit', $this->id);
    }

    public function ecommercePage()
    {
        return route('ecommerce.products', [
            'coleccion' => Str::slug($this->id. '-' . $this->name)
        ]);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_collection_items', 'collection_id');
    }
}
