<?php

namespace App\Enums;

enum ShippingStatus: string
{
    case NotCreated          = 'not_created';
    case OrderPayPending     = 'order_pay_pending';
    case DispatchReady       = 'dispatch_ready';
    case Dispatched          = 'dispatched';
    case ProviderPending     = 'provider_pending';
    case Confirmed           = 'confirmed';
    case ProviderProcessing  = 'provider_processing';
    case CarrierRejected     = 'carrier_rejected';
    case Ready               = 'ready';
    case InTransit           = 'in_transit';
    case DeliveryNear        = 'delivery_near';
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
            ShippingStatus::NotCreated         => 'gray',
            ShippingStatus::OrderPayPending    => 'indigo',
            ShippingStatus::DispatchReady      => 'blue',
            ShippingStatus::ProviderPending    => 'yellow',
            ShippingStatus::Confirmed          => 'emerald',
            ShippingStatus::Ready              => 'blue',
            ShippingStatus::ProviderProcessing => 'blue',
            ShippingStatus::InTransit          => 'blue',
            ShippingStatus::InBranch           => 'lime',
            ShippingStatus::Dispatched         => 'indigo',
            ShippingStatus::DeliveryNear       => 'lime',
            ShippingStatus::Delivered          => 'green',
            ShippingStatus::CarrierRejected    => 'red',
            ShippingStatus::CarrierCancelled   => 'red',
            ShippingStatus::Cancelled          => 'red',
            ShippingStatus::Returned           => 'indigo',
            ShippingStatus::Sinister           => 'orange'
        };
    }

    public function name(): string
    {
        return match($this)
        {
            ShippingStatus::NotCreated         => 'No creado',
            ShippingStatus::OrderPayPending    => 'Pago pendiente',
            ShippingStatus::DispatchReady      => 'Listo para despachar',
            ShippingStatus::Dispatched         => 'Despachado',
            ShippingStatus::ProviderPending    => 'Esperando confirmación',
            ShippingStatus::Confirmed          => 'Confirmado',
            ShippingStatus::Ready              => 'Preparado',
            ShippingStatus::ProviderProcessing => 'Procesando',
            ShippingStatus::DeliveryNear       => 'Entrega cercana',
            ShippingStatus::InTransit          => 'En camino',
            ShippingStatus::InBranch           => 'En sucursal destino',
            ShippingStatus::Delivered          => 'Entregado',
            ShippingStatus::CarrierRejected    => 'Cancelado',
            ShippingStatus::CarrierCancelled   => 'Cancelado',
            ShippingStatus::Cancelled          => 'Cancelado',
            ShippingStatus::Returned           => 'Retornado',
            ShippingStatus::Sinister           => 'Siniestro'
        };
    }

    public function customerName(): string
    {
        return match($this)
        {
            ShippingStatus::NotCreated         => 'Pendiente',
            ShippingStatus::OrderPayPending    => 'Pendiente',
            ShippingStatus::ProviderPending    => 'Pendiente',
            ShippingStatus::DispatchReady      => 'Preparado',
            ShippingStatus::Dispatched         => 'Despachado',
            ShippingStatus::Confirmed          => 'Preparado',
            ShippingStatus::ProviderProcessing => 'Preparando',
            ShippingStatus::DeliveryNear       => 'Cerca',
            ShippingStatus::Ready              => 'Preparado',
            ShippingStatus::InTransit          => 'En camino',
            ShippingStatus::Delivered          => 'Entregado',
            ShippingStatus::CarrierCancelled   => 'Cancelado',
            ShippingStatus::Cancelled          => 'Cancelado',
            ShippingStatus::CarrierRejected    => 'Cancelado',
            ShippingStatus::Returned           => 'Retornado',
            ShippingStatus::Sinister           => 'Siniestro'
        };
    }

    public function helper(): string
    {
        return match($this)
        {
            ShippingStatus::NotCreated         => 'La orden de envío no ha sido creada',
            ShippingStatus::OrderPayPending    => 'Debes abonar la orden de envío para confirmarla',
            ShippingStatus::ProviderPending    => 'La orden de envío ha sido creada. Se espera que el proveedor la confirme',
            ShippingStatus::ProviderProcessing => 'La orden de envío está siendo procesada por el proveedor',
            ShippingStatus::DispatchReady      => 'El pedido está listo para ser despachado',
            ShippingStatus::Dispatched         => 'Realizaste el despacho del pedido para su envío',
            ShippingStatus::Confirmed          => 'La orden de envío se ha confirmado correctamente',
            ShippingStatus::Ready              => 'El proveedor está listo para entregar el pedido',
            ShippingStatus::DeliveryNear       => 'El pedido está a punto de ser entregado',
            ShippingStatus::InTransit          => 'El pedido está en camino',
            ShippingStatus::Delivered          => 'El pedido fue entregado correctamente',
            ShippingStatus::CarrierCancelled   => 'El envío fue cancelado por el proveedor',
            ShippingStatus::CarrierRejected    => 'El envío fue cancelado por el transportista',
            ShippingStatus::Cancelled          => 'Cancelaste el envío del pedido',
            ShippingStatus::Returned           => 'El envío ha sido retornado correctamente',
            ShippingStatus::Sinister           => 'Ocurrió un siniestro en el viaje del pedido'
        };
    }

    public function customerHelper(): string
    {
        return match($this)
        {
            ShippingStatus::NotCreated         => 'Estamos preparando todo para el envío, pronto tendrás novedades',
            ShippingStatus::OrderPayPending    => 'Estamos preparando todo para el envío, pronto tendrás novedades',
            ShippingStatus::ProviderPending    => 'Estamos preparando todo para el envío, pronto tendrás novedades',
            ShippingStatus::ProviderProcessing => 'Estamos preparando todo para el envío, pronto tendrás novedades',
            ShippingStatus::DispatchReady      => 'Tu pedido está listo para ser despachado y pronto estará en viaje',
            ShippingStatus::Dispatched         => 'Tu pedido fue despachado, recibiras noticias del viaje muy pronto',
            ShippingStatus::Confirmed          => 'Tu pedido estará pronto en viaje',
            ShippingStatus::DeliveryNear       => '¡Preparate! tu pedido está muy cerca',
            ShippingStatus::Ready              => 'Tu pedido estará pronto en viaje',
            ShippingStatus::InTransit          => 'Tu pedido está en camino',
            ShippingStatus::Delivered          => 'Tu pedido ha sido entregado',
            ShippingStatus::CarrierCancelled   => 'El envío tuvo que ser cancelado por el transportista, por favor, ponte en contacto a la brevedad',
            ShippingStatus::Cancelled          => 'El envío de tu pedido tuvo que ser cancelado',
            ShippingStatus::CarrierRejected    => 'El transportista canceló el pedido, ponte en contacto para más detalles',
            ShippingStatus::Returned           => 'Tu pedido fue devuelto',
            ShippingStatus::Sinister           => 'Ocurrió un incidente en el viaje de tu pedido, por favor, ponte en contacto a la brevedad'
        };
    }
}