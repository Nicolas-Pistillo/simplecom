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
            'code'            => OrderStatusCode::Created,
            'name'            => 'En proceso',
            'customer_name'   => 'En proceso',
            'display_color'   => 'gray',
            'helper'          => 'El pedido fue creado correctamente y se está procesando internamente',
            'customer_helper' => 'Estamos procesando tu pedido, pronto tendrás novedades'
        ]);

        OrderStatus::create([
            'code'            => OrderStatusCode::PayPending,
            'name'            => 'Pago pendiente',
            'customer_name'   => 'Pago pendiente',
            'display_color'   => 'orange',
            'helper'          => 'Se espera confirmación de pago por parte del comprador',
            'customer_helper' => 'Finalizá tu pago para confirmar tu pedido'
        ]);

        OrderStatus::create([
            'code'            => OrderStatusCode::TransferPending,
            'name'            => 'Transferencia pendiente',
            'customer_name'   => 'Transferencia pendiente',
            'display_color'   => 'orange',
            'helper'          => 'Se espera que el comprador envíe el comprobante de transferencia',
            'customer_helper' => 'Recordá adjuntar el comprobante de transferencia una vez que '
        ]);

        OrderStatus::create([
            'code'            => OrderStatusCode::Confirmed,
            'name'            => 'Preparar',
            'customer_name'   => 'En preparación',
            'display_color'   => 'blue',
            'helper'          => 'Prepará el pedido para su entrega',
            'customer_helper' => 'Tu pedido ya se encuentra en preparación, te notificaremos cuando haya actualizaciones'
        ]);

        OrderStatus::create([
            'code'            => OrderStatusCode::DispatchPending,
            'name'            => 'Listo para despachar',
            'customer_name'   => 'En preparación',
            'display_color'   => 'blue',
            'helper'          => 'Llevá el pedido al punto de despacho correspondiente o preparalo para su colecta',
            'customer_helper' => 'Tu pedido está listo para ser despachado, pronto recibiras novedades sobre el envío'
        ]);

        OrderStatus::create([
            'code'            => OrderStatusCode::PickupReady,
            'name'            => 'Listo para entregar',
            'customer_name'   => 'Listo para retirar',
            'display_color'   => 'emerald',
            'helper'          => 'Ya notificamos al comprador para que pase a retirar el pedido',
            'customer_helper' => '¡Todo Listo! acercate a buscar tu pedido al punto de entrega'
        ]);

        OrderStatus::create([
            'code'            => OrderStatusCode::Dispatched,
            'name'            => 'Despachado',
            'customer_name'   => 'Despachado',
            'display_color'   => 'blue',
            'helper'          => 'Despachaste este pedido correctamente',
            'customer_helper' => 'Tu pedido ya está en manos del transportista y estará en camino próximamente'
        ]);

        OrderStatus::create([
            'code'            => OrderStatusCode::InTransit,
            'name'            => 'En camino',
            'customer_name'   => 'En camino',
            'display_color'   => 'blue',
            'helper'          => 'El transportista ya comenzó el recorrido para la entrega del pedido',
            'customer_helper' => 'El transportista ya se encuentra en viaje para la entrega de tu pedido'
        ]);

        OrderStatus::create([
            'code'            => OrderStatusCode::Delivered,
            'name'            => 'Entregado',
            'customer_name'   => 'Entregado',
            'display_color'   => 'green',
            'helper'          => '¡Felicitaciones! Entregaste este pedido 🎉',
            'customer_helper' => 'Recibiste tu pedido 🎉 ¡esperamos que lo disfrutes!'
        ]);

        OrderStatus::create([
            'code'            => OrderStatusCode::RefundRequested,
            'name'            => 'Reembolso solicitado',
            'customer_helper' => 'Reembolso solicitado',
            'display_color'   => 'yellow',
            'helper'          => 'El comprador solicitó el reembolso de este pedido',
            'customer_helper' => 'Recibimos tu solicitud de reembolso y nos estaremos contactando a la brevedad'
        ]);

        OrderStatus::create([
            'code'            => OrderStatusCode::Refunded,
            'name'            => 'Reembolsado',
            'customer_helper' => 'Reembolsado',
            'display_color'   => 'orange',
            'helper'          => 'Se completó el reembolso del pedido',
            'customer_helper' => 'Recibirás el reembolso del pedido próximamente'
        ]);

        OrderStatus::create([
            'code'            => OrderStatusCode::Cancelled,
            'name'            => 'Cancelado',
            'customer_helper' => 'Cancelado',
            'display_color'   => 'red',
            'helper'          => 'Cancelaste este pedido, se reasignará el stock de los productos',
            'customer_helper' => 'Tuvimos que cancelar este pedido, lamentamos las molestias ocacionadas'
        ]);
    }
}
