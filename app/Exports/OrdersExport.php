<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithMapping, WithHeadings
{
    protected $orders;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->orders;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Estado',
            'Cliente',
            'Tipo de Entrega',
            'Medio de pago',
            'Importe de Envío',
            'Subtotal',
            'Total',
            'Fecha'
        ];
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->status->name(),
            $order->user->full_name,
            $order->delivery_type->name(),
            $order->paymentMethod->display_name,
            ($order->shipping_cost > 0) ? "$$order->shipping_cost" : '-',
            '$' . $order->subtotal,
            '$' . $order->total,
            $order->created_at->format('d/m/Y H:i:s')
        ];
    }
}
