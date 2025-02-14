<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\OrderShipping;
use App\Services\ShippingProviders\Andreani;
use Illuminate\Http\Request;

class ShippingLabelController extends Controller
{
    public function andreaniLabel(OrderShipping $orderShipping)
    {
        if (empty($orderShipping->label_code)) abort(404);

        $andreani = new Andreani();

        $pdf = $andreani->getLabelPdf($orderShipping->label_code);

        return response($pdf, 200, ['Content-Type' => 'application/pdf']);
    }
}
