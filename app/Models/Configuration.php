<?php

namespace App\Models;

use App\Enums\InputType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $casts = [
        'input_type' => InputType::class
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
