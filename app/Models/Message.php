<?php

namespace App\Models;

use App\Enums\MessageTopic;
use App\Livewire\Forms\IndexMessagesFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'topic'      => MessageTopic::class,
        'replied_at' => 'datetime'
    ];

    public function scopeAdminSearch(Builder $query, string $search)
    {
        if (!empty(trim($search)))
        {
            $search = stripslashes(trim($search));

            $query->where(function($query) use ($search)
            {
                $query->where('id', 'LIKE', "%$search%")
                      ->orWhere('sender_name', 'LIKE', "%$search%")
                      ->orWhere('sender_email', 'LIKE', "%$search%")
                      ->orWhere('sender_phone', 'LIKE', "%$search%")
                      ->orWhere('subject', 'LIKE', "%$search%")
                      ->orWhere('message', 'LIKE', "%$search%");
            });
        }
    }

    public function scopeAdminFilter(Builder $query, IndexMessagesFilters $filters)
    {
        $query->where(function ($query) use ($filters)
        {
            if (!empty($filters->topic))
            {
                $query->where('topic', $filters->topic);
            }

            if ($filters->only_unreplied)
            {
                $query->whereNull('reply');
            }

            if ($filters->only_unread)
            {
                $query->where('read', false);
            }
        });
    }

    public function scopeUnread(Builder $query)
    {
        return $query->where('read', false);
    }

    public function operator()
    {
        return $this->hasOne(Operator::class, 'id', 'replied_by');
    }

    public function pageUrl()
    {
        return route('admin.messages.show', $this->id);
    }
}
