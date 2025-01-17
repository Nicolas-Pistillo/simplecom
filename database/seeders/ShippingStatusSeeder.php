<?php

namespace Database\Seeders;

use App\Enums\ShippingStatusCode;
use App\Models\ShippingStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShippingStatus::create([
            'code'            => ShippingStatusCode::CreationPending,
            'name'            => 'No creado',
            'display_color'   => 'gray',
            'helper'          => 'La orden de envío no ha sido creada',
        ]);

        ShippingStatus::create([
            'code'            => ShippingStatusCode::Created,
            'name'            => 'Orden creada',
            'display_color'   => 'indigo',
            'helper'          => 'La orden de envío ha sido creada exitosamente',
        ]);

        ShippingStatus::create([
            'code'            => ShippingStatusCode::ProviderPending,
            'name'            => 'Esperando confirmación',
            'display_color'   => 'yellow',
            'helper'          => 'La orden de envío se ha creado y está pendiente de confirmación por parte del proveedor',
        ]);

        ShippingStatus::create([
            'code'            => ShippingStatusCode::SellerPending,
            'name'            => 'Esperando tu confirmación',
            'display_color'   => 'yellow',
            'helper'          => 'La orden de envío se ha creado y debes confirmarla en la plataforma del proveedor',
        ]);

        ShippingStatus::create([
            'code'            => ShippingStatusCode::Confirmed,
            'name'            => 'Envío confirmado',
            'display_color'   => 'emerald',
            'helper'          => 'La orden de envío se ha confirmado y espera a ser procesada a la brevedad',
        ]);

        ShippingStatus::create([
            'code'            => ShippingStatusCode::Ready,
            'name'            => 'Preparando viaje',
            'display_color'   => 'blue',
            'helper'          => 'El pedido estara en viaje pronto',
        ]);

        ShippingStatus::create([
            'code'            => ShippingStatusCode::InTransit,
            'name'            => 'En viaje',
            'display_color'   => 'blue',
            'helper'          => 'El pedido está en camino',
        ]);

        ShippingStatus::create([
            'code'            => ShippingStatusCode::Delivered,
            'name'            => 'Entregado',
            'display_color'   => 'green',
            'helper'          => 'El pedido llegó a su destino exitosamente',
        ]);

        ShippingStatus::create([
            'code'            => ShippingStatusCode::CarrierCancelled,
            'name'            => 'Cancelado',
            'display_color'   => 'red',
            'helper'          => 'El proveedor tuvo que cancelar el envío del pedido',
        ]);

        ShippingStatus::create([
            'code'            => ShippingStatusCode::Cancelled,
            'name'            => 'Cancelado',
            'display_color'   => 'red',
            'helper'          => 'Cancelaste el envío del pedido',
        ]);
    }
}
