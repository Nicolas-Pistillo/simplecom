<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Created                = 'created';
    case PaymentPending         = 'payment_pending';
    case ProviderPayRevision    = 'provider_pay_revision';
    case ProviderPayClaimed     = 'provider_pay_claimed';
    case ProviderPayProcessing  = 'provider_pay_processing';
    case PaymentCancelled       = 'payment_cancelled';
    case PaymentRejected        = 'payment_rejected';
    case InMediation            = 'in_mediation';
    case Confirmed              = 'confirmed';
    case DispatchReady          = 'dispatch_ready';
    case Dispatched             = 'dispatched';
    case PickupReady            = 'pickup_ready';
    case InTransit              = 'in_transit';
    case Delivered              = 'delivered';
    case RefundRequested        = 'refund_requested';
    case Refunded               = 'refunded';
    case Cancelled              = 'cancelled';

    public function color(): string
    {
        return match($this)
        {
            OrderStatus::Created                => 'gray',
            OrderStatus::PaymentPending         => 'orange',
            OrderStatus::ProviderPayRevision    => 'orange',
            OrderStatus::ProviderPayRevision    => 'yellow',
            OrderStatus::ProviderPayProcessing  => 'blue',
            OrderStatus::PaymentCancelled       => 'red',
            OrderStatus::PaymentRejected        => 'red',
            OrderStatus::InMediation            => 'indigo',
            OrderStatus::Confirmed              => 'blue',
            OrderStatus::DispatchReady          => 'blue',
            OrderStatus::Dispatched             => 'blue',
            OrderStatus::PickupReady            => 'emerald',
            OrderStatus::InTransit              => 'blue',
            OrderStatus::Delivered              => 'green',
            OrderStatus::RefundRequested        => 'yellow',
            OrderStatus::Refunded               => 'violet',
            OrderStatus::Cancelled              => 'red'
        };
    }

    public function name(): string
    {
        return match($this)
        {
            OrderStatus::Created                => 'Iniciado',
            OrderStatus::PaymentPending         => 'Pago pendiente',
            OrderStatus::ProviderPayRevision    => 'Pago en revisión',
            OrderStatus::ProviderPayClaimed     => 'Pago reclamado',
            OrderStatus::ProviderPayProcessing  => 'Procesando pago',
            OrderStatus::PaymentCancelled       => 'Pago cancelado',
            OrderStatus::PaymentRejected        => 'Pago rechazado',
            OrderStatus::InMediation            => 'Reclamo abierto',
            OrderStatus::Confirmed              => 'Preparar',
            OrderStatus::DispatchReady          => 'Listo para despachar',
            OrderStatus::Dispatched             => 'Despachado',
            OrderStatus::PickupReady            => 'Listo para entregar',
            OrderStatus::InTransit              => 'En camino',
            OrderStatus::Delivered              => 'Entregado',
            OrderStatus::RefundRequested        => 'Reembolso solicitado',
            OrderStatus::Refunded               => 'Reembolsado',
            OrderStatus::Cancelled              => 'Cancelado'
        };
    }

    public function customerName(): string
    {
        return match($this)
        {
            OrderStatus::Created                => 'En proceso',
            OrderStatus::PaymentPending         => 'Pago pendiente',
            OrderStatus::ProviderPayRevision    => 'Pago en revisión',
            OrderStatus::ProviderPayClaimed     => 'Pago reclamado',
            OrderStatus::ProviderPayProcessing  => 'Procesando pago',
            OrderStatus::PaymentCancelled       => 'Pago cancelado',
            OrderStatus::PaymentRejected        => 'Pago rechazado',
            OrderStatus::InMediation            => 'En reclamo',
            OrderStatus::Confirmed              => 'En preparación',
            OrderStatus::DispatchReady          => 'En preparación',
            OrderStatus::Dispatched             => 'Despachado',
            OrderStatus::PickupReady            => 'Listo para retirar',
            OrderStatus::InTransit              => 'En camino',
            OrderStatus::Delivered              => 'Entregado',
            OrderStatus::RefundRequested        => 'Reembolso solicitado',
            OrderStatus::Refunded               => 'Reembolsado',
            OrderStatus::Cancelled              => 'Cancelado'
        };
    }

    public function helper(): string
    {
        return match($this)
        {
            OrderStatus::Created                => 'El cliente esta procesando esta compra',
            OrderStatus::PaymentPending         => 'Se espera confirmación de pago por parte del comprador',
            OrderStatus::ProviderPayRevision    => 'El proveedor está revisando el pago realizado',
            OrderStatus::ProviderPayClaimed     => 'El comprador inicio un reclamo por el pago del pedido desde la plataforma del proveedor',
            OrderStatus::ProviderPayProcessing  => 'El pago está siendo procesado por el proveedor',
            OrderStatus::PaymentCancelled       => 'El pago del pedido fue cancelado',
            OrderStatus::PaymentRejected        => 'El pago del pedido fue rechazado, el comprador tiene posibilidad de reintento',
            OrderStatus::InMediation            => 'Resolvé el reclamo iniciado para este pedido',
            OrderStatus::Confirmed              => 'Prepará el pedido para su entrega',
            OrderStatus::DispatchReady          => 'Llevá el pedido al punto de despacho correspondiente o preparalo para su colecta',
            OrderStatus::Dispatched             => 'Despachaste este pedido correctamente, se esperan actualizaciones del envío',
            OrderStatus::PickupReady            => 'El comprador ya puede pasar a retirar el pedido',
            OrderStatus::InTransit              => 'El transportista ya comenzó el recorrido para la entrega del pedido',
            OrderStatus::Delivered              => '¡Felicitaciones! Entregaste este pedido 🎉',
            OrderStatus::RefundRequested        => 'El comprador solicitó el reembolso de este pedido',
            OrderStatus::Refunded               => 'Se completó el reembolso del pedido',
            OrderStatus::Cancelled              => 'El pedido ha sido cancelado'
        };
    }

    public function customerHelper()
    {
        return match($this)
        {
            OrderStatus::Created                => 'Tu pedido está en proceso y aún no se ha confirmado',
            OrderStatus::PaymentPending         => 'Finalizá tu pago para confirmar tu pedido',
            OrderStatus::ProviderPayRevision    => 'El procesador de pagos está revisando tu pago, te notificaremos cuando recibamos su confirmación',
            OrderStatus::ProviderPayClaimed     => 'Iniciaste un reclamo por este pedido',
            OrderStatus::ProviderPayProcessing  => 'Estamos esperando información del pago por parte del proveedor, en breve actualizaremos la información',
            OrderStatus::PaymentCancelled       => 'El pago del pedido fue cancelado',
            OrderStatus::PaymentRejected        => 'El pago de tu pedido fue rechazado, podes volver a intentarlo si lo deseas',
            OrderStatus::InMediation            => 'Iniciaste un reclamo por este pedido',
            OrderStatus::Confirmed              => 'Tu pedido se encuentra en preparación',
            OrderStatus::DispatchReady          => 'Tu pedido está listo para ser despachado, pronto recibiras novedades sobre el envío',
            OrderStatus::Dispatched             => 'Tu pedido ya está en manos del transportista y estará en camino próximamente',
            OrderStatus::PickupReady            => '¡Todo Listo! acercate a buscar tu pedido al punto de entrega',
            OrderStatus::InTransit              => 'Tu pedido está en camino',
            OrderStatus::Delivered              => 'Recibiste tu pedido 🎉 ¡esperamos que lo disfrutes!',
            OrderStatus::RefundRequested        => 'Recibimos tu solicitud de reembolso y nos estaremos contactando a la brevedad',
            OrderStatus::Refunded               => 'El dinero de tu pago ha sido reembolsado correctamente',
            OrderStatus::Cancelled              => 'El pedido ha sido cancelado'
        };
    }
}