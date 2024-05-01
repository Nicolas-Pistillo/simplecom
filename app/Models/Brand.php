<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['brandfetch_id', 'name', 'image_url', 'published'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
