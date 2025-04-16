<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCollectionItem extends Model
{
    use HasFactory;

    protected $fillable = ['collection_id', 'product_id'];
}
