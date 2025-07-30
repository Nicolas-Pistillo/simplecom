<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\CustomerType;
use App\Enums\TaxCondition;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $appends = ['full_name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password'      => 'hashed',
        'type'          => CustomerType::class,
        'tax_condition' => TaxCondition::class
    ];

    public function getFullNameAttribute()
    {
        return "$this->name $this->lastname";
    }

    public function pageUrl()
    {
        return route('admin.customers.show', $this->id);
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function wishlist()
    {
        return $this->hasMany(WishlistItem::class);
    }

    public function scopeRegistered(Builder $query)
    {
        $query->where('type', CustomerType::Registered);
    }

    public function scopeGuest(Builder $query)
    {
        $query->where('type', CustomerType::Guest);
    }

    public function scopeSearch(Builder $query, string $search)
    {
        if (!empty(trim($search)))
        {
            $search = stripslashes(trim($search));

            $query->where(function($query) use ($search)
            {
                $query->where('id', 'LIKE', "%$search%");

                $query->orWhere('name', 'LIKE', "%$search%");

                $query->orWhere('lastname', 'LIKE', "%$search%");

                $query->orWhere('email', 'LIKE', "%$search%");

                $query->orWhere('phone', 'LIKE', "%$search%");

                $query->orWhere('document', 'LIKE', "%$search%");

                $query->orWhere('invoice_social_reason', 'LIKE', "%$search%");

                $query->orWhere('invoice_address', 'LIKE', "%$search%");

                $query->orWhere('invoice_document', 'LIKE', "%$search%");
            });
        }
    }
}
