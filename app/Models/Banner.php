<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image_url', 'order', 'link', 'published'];

    public function scopePublished(Builder $query): void
    {
        $query->where('published', true);
    }
}
