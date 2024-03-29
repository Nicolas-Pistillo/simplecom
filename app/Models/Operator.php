<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class Operator extends Authenticatable
{
    use HasFactory;
    use HasRoles;

    protected $guard = "operator";

    protected $appends = ['role'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'area'
    ];

    protected $hidden = [
        'password'
    ];

    public function getRoleAttribute()
    {
        return $this->roles?->first()?->name;
    }
}
