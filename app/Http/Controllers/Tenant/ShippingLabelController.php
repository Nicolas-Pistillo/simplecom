<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\OrderShipping;
use App\Services\ShippingProviders\Andreani;
use App\Services\ShippingProviders\Mocis;
use App\Services\ShippingProviders\Zippin;
use Illuminate\Http\Request;

class ShippingLabelController extends Controller
{
    public function andreani(OrderShipping $shipping)
    {
        if (empty($shipping->label_code)) abort(404);

        $andreani = new Andreani();

        try 
        {
            $pdf = $andreani->getLabelPdf($shipping);
            return response($pdf, 200, ['Content-Type' => 'application/pdf']);

        } catch (\Throwable $err) 
        {
            die("No se pudo descargar la etiqueta, mensaje del error: " . $err->getMessage());
        }
    }

    public function zippin(OrderShipping $shipping)
    {
        if (empty($shipping->external_id)) abort(404);

        $zippin = new Zippin();

        try 
        {
            $pdf = $zippin->getLabelPdf($shipping);
            return response($pdf, 200, ['Content-Type' => 'application/pdf']);

        } catch (\Throwable $err) 
        {
            die("No se pudo descargar la etiqueta, mensaje del error: " . $err->getMessage());
        }
    }

    public function mocis(OrderShipping $shipping)
    {
        if (empty($shipping->external_id)) abort(404);

        $mocis = new Mocis();

        try 
        {
            $labelUrl = $mocis->getLabelUrl($shipping);
            return redirect($labelUrl);

        } catch (\Throwable $err) 
        {
            die("No se pudo descargar la etiqueta, mensaje del error: " . $err->getMessage());
        }
    }
}
