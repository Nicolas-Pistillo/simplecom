<?php

namespace App\Models;

use App\Enums\OrderFeedEvent;
use App\Enums\OrderFeedPresentation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderFeedItem extends Model
{
    use HasFactory;

    protected $table = 'order_feeds';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'event'        => OrderFeedEvent::class,
        'presentation' => OrderFeedPresentation::class
    ];
}
