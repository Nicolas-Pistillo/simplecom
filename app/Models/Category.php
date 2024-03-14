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
        'category_father', 
        'image_url', 
        'cover_image_url'
    ];

    public function childs()
    {
        return $this->hasMany(Category::class, 'category_father');
    }

    public function scopePrincipal(Builder $query): void
    {
        $query->whereNull('category_father');        
    }
}
