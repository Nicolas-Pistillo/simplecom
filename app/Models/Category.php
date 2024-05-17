<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description',
        'published',
        'featured',
        'category_father', 
        'image_url', 
        'cover_image_url'
    ];

    public function father()
    {
        return $this->belongsTo(Category::class, 'category_father');
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'category_father');
    }

    public function hasChilds()
    {
        return $this->childs()->count() > 0;
    }

    public function scopePrincipal(Builder $query): void
    {
        $query->whereNull('category_father');
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('published', true);
    }
}
