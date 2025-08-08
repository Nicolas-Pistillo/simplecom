<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'response', 'published', 'created_by'];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class, 'created_by');
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('published', true);
    }
}
