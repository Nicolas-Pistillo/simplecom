<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PDFController extends Controller
{
    public function orderLabels(Request $request)
    {
        if (!$request->has('orders') || !is_array($request->orders)) abort(404);

        $orders = Order::with('user', 'shipping.userAddress', 'storePickup')->findMany($request->orders);

        $orders->each(
            fn($order) => $order->qr_code = base64_encode(QrCode::format('png')->size(300)->generate("ALOHOMORA"))
        );

        $pdf = Pdf::loadView('pdf.order-labels', [
            'orders' => $orders
        ]);

        return $pdf->stream();
    }
}
