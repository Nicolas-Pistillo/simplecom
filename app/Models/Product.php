<?php

namespace App\Models;

use App\Livewire\Forms\IndexProductsFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['images_dir', 'first_image', 'current_price'];

    public function detailPageUrl()
    {
        return route('ecommerce.product-detail', [Str::slug($this->name), $this->id]);
    }

    public function editPageUrl()
    {
        return route('admin.products.edit', $this->id);
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

    public function getCurrentPriceAttribute()
    {
        if (!$this->hasDiscount()) return $this->price;
        return $this->price - (($this->price * $this->discount_percent) / 100);
    }

    public function hasDiscount()
    {
        return !empty($this->discount_percent) && $this->discount_percent > 0;
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

    public function isOnUserWishlist()
    {
        if (Auth::guest()) return false;
        return Auth::user()->wishlist()->where('product_id', $this->id)->exists();
    }

    public function scopeAvailable(Builder $query): void
    {
        $query->where(function ($query) 
        {
            $query->where('published', 1)
                ->where('stock', '>', 0)
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

    public function scopeAdminSearch(Builder $query, string $search)
    {
        if (!empty(trim($search)))
        {
            $search = stripslashes(trim($search));

            $query->where(function($query) use ($search)
            {
                $query->where('name', 'LIKE', "%$search%")
                      ->orWhere('id', 'LIKE', "%$search%")
                      ->orWhere('code', 'LIKE', "%$search%");
    
                $query->orWhereHas('category', function($q) use ($search) 
                {
                    $q->where('name', 'LIKE', "%$search%");
                });
    
                $query->orWhereHas('tags', function($q) use ($search) 
                {
                    $q->where('name', 'LIKE', "%$search%");
                });
            });
        }
    }

    public function scopeAdminFilter(Builder $query, IndexProductsFilters $filters)
    {
        $query->where(function ($query) use ($filters)
        {
            if ($filters->brand_id > 0)
            {
                $query->where('brand_id', $filters->brand_id);
            }

            if ($filters->category_id > 0)
            {
                $query->where('category_id', $filters->category_id);
            }

            if ($filters->only_published)
            {
                $query->where('published', true);
            }

            if ($filters->only_featured)
            {
                $query->where('featured', true);
            }
        });
    }

    public function scopeOrderByType(Builder $query, $orderType)
    {
        switch ($orderType)
        {
            case 'relevantes':   $query->orderByRelevants();  break;
            case 'nuevos':       $query->orderByNews();       break;
            case 'menor_precio': $query->orderByCheaps();     break;
            case 'mayor_precio': $query->orderByExpensives(); break;
            default:             $query->orderByRelevants();
        }
    }

    public function scopeOrderByRelevants(Builder $query): void
    {
        $query->orderBy('featured', 'DESC')
              ->orderBy('discount_percent', 'DESC');
    }

    public function scopeOrderByNews(Builder $query)
    {
        $query->orderBy('created_at', 'DESC');
    }

    public function scopeOrderByCheaps(Builder $query): void
    {
        $query->orderBy('price');
    }

    public function scopeOrderByExpensives(Builder $query): void
    {
        $query->orderBy('price', 'DESC');
    }

    public function scopeFeatured(Builder $query): void
    {
        $query->where('featured', true);
    }
}
