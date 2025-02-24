<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\OrderShipping;
use Illuminate\Http\Request;

class ShippingLabelController extends Controller
{
    public function andreani(OrderShipping $orderShipping)
    {
        if (empty($orderShipping->label_code)) abort(404);

        return $orderShipping->downloadLabel();
    }

    public function zippin(OrderShipping $orderShipping)
    {
        if (empty($orderShipping->external_id)) abort(404);

        return $orderShipping->downloadLabel();
    }
}
