<?php

namespace App\Models;

use App\Enums\InvoiceType;
use App\Enums\InvoiceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'type'   => InvoiceType::class,
        'status' => InvoiceStatus::class
    ];
}
