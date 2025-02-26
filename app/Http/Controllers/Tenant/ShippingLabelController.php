<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\OrderShipping;
use Illuminate\Http\Request;

class ShippingLabelController extends Controller
{
    public function andreani(OrderShipping $shipping)
    {
        if (empty($shipping->label_code)) abort(404);

        return $shipping->downloadLabel();
    }

    public function zippin(OrderShipping $shipping)
    {
        if (empty($shipping->external_id)) abort(404);

        return $shipping->downloadLabel();
    }

    public function mocis(OrderShipping $shipping)
    {
        if (empty($shipping->external_id)) abort(404);

        return $shipping->downloadLabel($shipping);
    }
}
