<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function orderLabels(Request $request)
    {
        if (!$request->has('orders') || !is_array($request->orders)) abort(404);

        $pdf = Pdf::loadView('pdf.order-labels', [
            'orders' => Order::with('user', 'shipping')->findMany($request->orders)->toArray()
        ]);

        return $pdf->stream();
    }
}
