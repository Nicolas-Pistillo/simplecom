<?php

namespace Database\Seeders;

use App\Enums\OrderStatusCode;
use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderStatus::create([
            'code'          => OrderStatusCode::Created,
            'name'          => 'Creado',
            'display_color' => 'gray',
            'helper'        => 'El pedido fue creado correctamente pero aún no se ha procesado'
        ]);

        OrderStatus::create([
            'code'          => OrderStatusCode::PayPending,
            'name'          => 'Pendiente de Pago',
            'display_color' => 'orange',
            'helper'        => 'Se espera confirmación de pago por parte del comprador'
        ]);

        OrderStatus::create([
            'code'          => OrderStatusCode::TransferPending,
            'name'          => 'Transferencia Pendiente',
            'display_color' => 'orange',
            'helper'        => 'Se espera que el comprador envíe el comprobante de transferencia'
        ]);

        OrderStatus::create([
            'code'          => OrderStatusCode::Confirmed,
            'name'          => 'Confirmado',
            'display_color' => 'green',
            'helper'        => 'El pedido fue confirmado correctamente pero aún no se ha procesado'
        ]);

        OrderStatus::create([
            'code'          => OrderStatusCode::DispatchPending,
            'name'          => 'Listo para Despachar',
            'display_color' => 'indigo',
            'helper'        => 'Llevá el pedido al punto de despacho correspondiente'
        ]);

        OrderStatus::create([
            'code'          => OrderStatusCode::Dispatched,
            'name'          => 'Despachado',
            'display_color' => 'blue',
            'helper'        => 'Despachaste este pedido correctamente'
        ]);

        OrderStatus::create([
            'code'          => OrderStatusCode::InTransit,
            'name'          => 'En camino',
            'display_color' => 'blue',
            'helper'        => 'El transportista ya comenzó el recorrido para la entrega del pedido'
        ]);

        OrderStatus::create([
            'code'          => OrderStatusCode::Delivered,
            'name'          => 'Entregado',
            'display_color' => 'blue',
            'helper'        => '¡Felicitaciones! Entregaste este pedido 🎉'
        ]);

        OrderStatus::create([
            'code'          => OrderStatusCode::RefundRequested,
            'name'          => 'Reembolso Solicitado',
            'display_color' => 'yellow',
            'helper'        => 'El comprador solicitó el reembolso de este pedido'
        ]);

        OrderStatus::create([
            'code'          => OrderStatusCode::Refunded,
            'name'          => 'Reembolsado',
            'display_color' => 'orange',
            'helper'        => 'Se completó el reembolso del pedido'
        ]);

        OrderStatus::create([
            'code'          => OrderStatusCode::Cancelled,
            'name'          => 'Cancelado',
            'display_color' => 'red',
            'helper'        => 'Cancelaste este pedido, se reasignará el stock de los productos'
        ]);
    }
}
