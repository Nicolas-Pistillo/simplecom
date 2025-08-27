<?php

namespace App\Models;

use App\Enums\IncentiveType;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incentive extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'title', 'description', 'published', 'created_by'];

    protected $casts = [
        'type' => IncentiveType::class
    ];

    public function scopePublished(Builder $query)
    {
        return $query->where('published', true);
    }
}
