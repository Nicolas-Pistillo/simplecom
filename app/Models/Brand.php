<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image_url', 'published', 'featured'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function pageUrl()
    {
        return route('ecommerce.products', [
            'marca' => Str::slug($this->id. '-' . $this->name)
        ]);
    }
}
