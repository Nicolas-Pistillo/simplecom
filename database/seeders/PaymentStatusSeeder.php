<?php

namespace Database\Seeders;

use App\Enums\PaymentStatusCode;
use App\Models\PaymentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentStatus::create([
            'code'            => PaymentStatusCode::Created,
            'name'            => 'Iniciado',
            'customer_name'   => 'Compra en proceso',
            'display_color'   => 'gray',
            'helper'          => 'El cliente inició el proceso de pago pero aún no lo ha completado',
            'customer_helper' => 'Finalizá tu compra para confirmar tu pedido'
        ]);

        PaymentStatus::create([
            'code'            => PaymentStatusCode::Pending,
            'name'            => 'Pendiente',
            'customer_name'   => 'Pendiente',
            'display_color'   => 'orange',
            'helper'          => 'El comprador debe finalizar el pago',
            'customer_helper' => 'Completá el pago de tu pedido para confirmarlo'
        ]);

        PaymentStatus::create([
            'code'            => PaymentStatusCode::TransferPending,
            'name'            => 'Transferencia pendiente',
            'customer_name'   => 'Transferencia pendiente',
            'display_color'   => 'yellow',
            'helper'          => 'Se espera que el comprador envíe el comprobante de transferencia',
            'customer_helper' => 'Recordá adjuntar el comprobante de transferencia una vez que la realices'
        ]);

        PaymentStatus::create([
            'code'            => PaymentStatusCode::Confirmed,
            'name'            => 'Preparar',
            'customer_name'   => 'Confirmado',
            'display_color'   => 'green',
            'helper'          => 'El pago se confirmó exitosamente',
            'customer_helper' => 'Tu pago ha sido confirmado'
        ]);

        PaymentStatus::create([
            'code'            => PaymentStatusCode::Rejected,
            'name'            => 'Rechazado',
            'customer_name'   => 'Rechazado',
            'display_color'   => 'red',
            'helper'          => 'El pago del pedido fue rechazado, el comprador puede volver a intentar el pago',
            'customer_helper' => 'Tu pago ha sido rechazado, podes reintentarlo'
        ]);

        PaymentStatus::create([
            'code'            => PaymentStatusCode::InRevision,
            'name'            => 'En revisión',
            'customer_name'   => 'En revisión',
            'display_color'   => 'yellow',
            'helper'          => 'El pago del pedido esta siendo revisando por el proveedor',
            'customer_helper' => 'El proveedor esta revisando el pago de este pedido, te notificaremos apenas recibamos actualizaciones'
        ]);

        PaymentStatus::create([
            'code'            => PaymentStatusCode::Authorized,
            'name'            => 'Autorizado',
            'customer_name'   => 'Autorizado',
            'display_color'   => 'green',
            'helper'          => 'El pago del pedido fue autorizado pero aún no se ha terminado de recaudar',
            'customer_helper' => 'El pago de tu pedido fue autorizado correctamente'
        ]);

        PaymentStatus::create([
            'code'            => PaymentStatusCode::Cancelled,
            'name'            => 'Rechazado',
            'customer_name'   => 'Rechazado',
            'display_color'   => 'red',
            'helper'          => 'El pago de este pedido fue rechazado',
            'customer_helper' => 'El pago de tu pedido fue rechazado'
        ]);

        PaymentStatus::create([
            'code'            => PaymentStatusCode::CustomerCancelled,
            'name'            => 'Rechazado',
            'customer_name'   => 'Cancelado',
            'display_color'   => 'red',
            'helper'          => 'El pago de este pedido fue rechazado por el comprador',
            'customer_helper' => 'Cancelaste el proceso de pago para este pedido'
        ]);

        PaymentStatus::create([
            'code'            => PaymentStatusCode::Refunded,
            'name'            => 'Reembolsado',
            'customer_name'   => 'Reembolsado',
            'display_color'   => 'violet',
            'helper'          => 'El pago ha sido reembolsado al comprador',
            'customer_helper' => 'Se ha efectuado el reembolso de tu pago'
        ]);

        PaymentStatus::create([
            'code'            => PaymentStatusCode::ProviderClaimed,
            'name'            => 'Reclamado',
            'customer_name'   => 'Reclamado',
            'display_color'   => 'yellow',
            'helper'          => 'El pago de este pedido fue reclamado desde la plataforma del proveedor',
            'customer_helper' => 'Recibimos el reclamo por el pago de este pedido'
        ]);

        PaymentStatus::create([
            'code'            => PaymentStatusCode::InProcess,
            'name'            => 'Procesando',
            'customer_name'   => 'Procesando',
            'display_color'   => 'yellow',
            'helper'          => 'Esperando los resultados del pago por parte del proveedor',
            'customer_helper' => 'Estamos procesando el pago de tu pedido, en breve actualizaremos la información'
        ]);
    }
}
