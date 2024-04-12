<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['images_dir'];

    public function getImagesDirAttribute()
    {
        return tenant('products_url') . "/$this->id";
    }

    public function getPresentationImage()
    {
        $image = ProductImage::where('product_id', $this->id)->where('order', 1)->first();

        if (!$image) return false;

        return Storage::url($image->url);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
