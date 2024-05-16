<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['images_dir', 'first_image'];

    public function detailPageUrl()
    {
        return route('ecommerce.product-detail', [Str::slug($this->name), $this->id]);
    }

    public function getImagesDirAttribute()
    {
        return tenant('products_url') . "/$this->id";
    }

    public function getFirstImageAttribute()
    {
        $image = ProductImage::where('product_id', $this->id)->where('order', 1)->first();

        if (!$image) return URL::to('img/no-image.png');

        return Storage::url($image->url);
    }

    public function hasDiscount()
    {
        return !empty($this->discount_percent) && $this->discount_percent > 0;
    }

    public function calculateDiscount()
    {
        if (!$this->hasDiscount()) return $this->price;
        return $this->price - (($this->price * $this->discount_percent) / 100);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function hasVariants()
    {
        return $this->variants()->count() > 0;
    }

    public function variantOptions()
    {
        return $this->hasMany(VariantOption::class);
    }

    public function getSelectableAttributes()
    {
        if (!$this->hasVariants()) return false;

        $attributeIds = $this->variantOptions()->select('attribute_id')->distinct()->get();

        $attributeIds = $attributeIds->pluck('attribute_id')->toArray();
        return Attribute::find($attributeIds);
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class, 'created_by');
    }

    public function scopeAvailable(Builder $query): void
    {
        $query->where(function ($query) {

            $query->where('published', 1)
                ->whereHas('category', function($q) {
                    $q->where('published', 1);
                })
                ->where(function($q) {
                    $q->whereDoesntHave('brand')->orWhereHas('brand', function($q) {
                        $q->where('published', 1);
                    });
                });

        });
    }

    public function scopeFeatured(Builder $query): void
    {
        $query->where('featured', 1);
    }
}
