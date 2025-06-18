<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Returns the associated service class for manage the order payment logic
     */
    public function service()
    {
        if (!$this->service_class) return null;

        return new $this->service_class();
    }
}
