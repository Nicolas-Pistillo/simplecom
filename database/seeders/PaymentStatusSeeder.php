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
            'code'            => PaymentStatusCode::PayPending,
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
            'helper'          => 'El pago del pedido fue rechazado',
            'customer_helper' => 'Tu pago ha sido rechazado'
        ]);
    }
}
