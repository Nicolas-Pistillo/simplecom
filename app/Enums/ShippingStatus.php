<?php

namespace App\Enums;

enum ShippingStatus: string
{
    case NotCreated          = 'not_created';
    case OrderPayPending     = 'order_pay_pending';
    case DispatchReady       = 'dispatch_ready';
    case ProviderPending     = 'provider_pending';
    case Confirmed           = 'confirmed';
    case Ready               = 'ready';
    case InTransit           = 'in_transit';
    case InBranch            = 'in_branch';
    case Delivered           = 'delivered';
    case CarrierCancelled    = 'carrier_cancelled';
    case Cancelled           = 'cancelled';
    case Returned            = 'returned';
    case Sinister            = 'sinister';

    public function color(): string
    {
        return match($this)
        {
            ShippingStatus::NotCreated       => 'gray',
            ShippingStatus::OrderPayPending  => 'indigo',
            ShippingStatus::DispatchReady    => 'blue',
            ShippingStatus::ProviderPending  => 'yellow',
            ShippingStatus::Confirmed        => 'emerald',
            ShippingStatus::Ready            => 'blue',
            ShippingStatus::InTransit        => 'blue',
            ShippingStatus::InBranch         => 'lime',
            ShippingStatus::Delivered        => 'green',
            ShippingStatus::CarrierCancelled => 'red',
            ShippingStatus::Cancelled        => 'red',
            ShippingStatus::Returned         => 'indigo',
            ShippingStatus::Sinister         => 'orange'
        };
    }

    public function name(): string
    {
        return match($this)
        {
            ShippingStatus::NotCreated       => 'No creado',
            ShippingStatus::OrderPayPending  => 'Pago pendiente',
            ShippingStatus::DispatchReady    => 'Listo para despachar',
            ShippingStatus::ProviderPending  => 'Esperando confirmación',
            ShippingStatus::Confirmed        => 'Confirmado',
            ShippingStatus::Ready            => 'Preparado',
            ShippingStatus::InTransit        => 'En camino',
            ShippingStatus::InBranch         => 'En sucursal destino',
            ShippingStatus::Delivered        => 'Entregado',
            ShippingStatus::CarrierCancelled => 'Cancelado',
            ShippingStatus::Cancelled        => 'Cancelado',
            ShippingStatus::Returned         => 'Retornado',
            ShippingStatus::Sinister         => 'Siniestro'
        };
    }

    public function customerName(): string
    {
        return match($this)
        {
            ShippingStatus::NotCreated       => 'Pendiente',
            ShippingStatus::OrderPayPending  => 'Pendiente',
            ShippingStatus::ProviderPending  => 'Pendiente',
            ShippingStatus::DispatchReady    => 'Preparado',
            ShippingStatus::Confirmed        => 'Preparado',
            ShippingStatus::Ready            => 'Preparado',
            ShippingStatus::InTransit        => 'En camino',
            ShippingStatus::Delivered        => 'Entregado',
            ShippingStatus::CarrierCancelled => 'Cancelado',
            ShippingStatus::Cancelled        => 'Cancelado',
            ShippingStatus::Returned         => 'Retornado',
            ShippingStatus::Sinister         => 'Siniestro'
        };
    }

    public function helper(): string
    {
        return match($this)
        {
            ShippingStatus::NotCreated       => 'La orden de envío no ha sido creada',
            ShippingStatus::OrderPayPending  => 'Debes abonar la orden de envío para confirmarla',
            ShippingStatus::ProviderPending  => 'La orden de envío ha sido creada. Se espera que el proveedor la confirme',
            ShippingStatus::DispatchReady    => 'El pedido está listo para ser despachado',
            ShippingStatus::Confirmed        => 'La orden de envío se ha confirmado y será procesada a la brevedad',
            ShippingStatus::Ready            => 'El proveedor está listo para entregar el pedido',
            ShippingStatus::InTransit        => 'El pedido está en camino',
            ShippingStatus::Delivered        => 'El pedido fue entregado correctamente',
            ShippingStatus::CarrierCancelled => 'El envío fue cancelado por el proveedor',
            ShippingStatus::Cancelled        => 'Cancelaste el envío del pedido',
            ShippingStatus::Returned         => 'El envío ha sido retornado correctamente',
            ShippingStatus::Sinister         => 'Ocurrió un siniestro en el viaje del pedido'
        };
    }

    public function customerHelper(): string
    {
        return match($this)
        {
            ShippingStatus::NotCreated       => 'Estamos preparando todo para el envío, pronto tendrás novedades',
            ShippingStatus::OrderPayPending  => 'Estamos preparando todo para el envío, pronto tendrás novedades',
            ShippingStatus::ProviderPending  => 'Estamos preparando todo para el envío, pronto tendrás novedades',
            ShippingStatus::DispatchReady    => 'El pedido está listo para ser despachado y pronto estará en viaje',
            ShippingStatus::Confirmed        => 'Tu pedido estará pronto en viaje',
            ShippingStatus::Ready            => 'Tu pedido estará pronto en viaje',
            ShippingStatus::InTransit        => 'Tu pedido está en camino',
            ShippingStatus::Delivered        => 'Tu pedido ha sido entregado',
            ShippingStatus::CarrierCancelled => 'El envío tuvo que ser cancelado por el transportista, por favor, ponte en contacto a la brevedad',
            ShippingStatus::Cancelled        => 'El envío de tu pedido tuvo que ser cancelado',
            ShippingStatus::Returned         => 'Tu pedido fue devuelto',
            ShippingStatus::Sinister         => 'Ocurrió un incidente en el viaje de tu pedido, por favor, ponte en contacto a la brevedad'
        };
    }
}