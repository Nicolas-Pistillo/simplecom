<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case Created               = 'created';
    case TransferPending       = 'transfer_pending';
    case Pending               = 'pending';
    case NeedsConfirmation     = 'needs_confirmation';
    case InProcess             = 'in_process';
    case Unauthorized          = 'unauthorized';
    case Authorized            = 'authorized';
    case ProviderClaimed       = 'provider_claimed';
    case InRevision            = 'in_revision';
    case Processed             = 'processed';
    case Confirmed             = 'confirmed';
    case Rejected              = 'rejected';
    case CancellationInProcess = 'cancel_process';
    case Cancelled             = 'cancelled';
    case CustomerCancelled     = 'customer_cancelled';
    case Refunded              = 'refunded';

    public function icon(): string
    {
        return match($this)
        {
            PaymentStatus::Created               => 'more_horiz',
            PaymentStatus::TransferPending       => 'account_balance',
            PaymentStatus::Pending               => 'more_horiz',
            PaymentStatus::NeedsConfirmation     => 'lock',
            PaymentStatus::InProcess             => 'overview',
            PaymentStatus::Authorized            => 'check',
            PaymentStatus::Unauthorized          => 'close',
            PaymentStatus::ProviderClaimed       => 'description',
            PaymentStatus::InRevision            => 'policy',
            PaymentStatus::Processed             => 'check',
            PaymentStatus::Confirmed             => 'check',
            PaymentStatus::Rejected              => 'close',
            PaymentStatus::CancellationInProcess => 'more_horiz',
            PaymentStatus::Cancelled             => 'close',
            PaymentStatus::CustomerCancelled     => 'close',
            PaymentStatus::Refunded              => 'cached',
        };
    }

    public function color(): string
    {
        return match($this)
        {
            PaymentStatus::Created               => 'gray',
            PaymentStatus::TransferPending       => 'yellow',
            PaymentStatus::Pending               => 'orange',
            PaymentStatus::NeedsConfirmation     => 'orange',
            PaymentStatus::InProcess             => 'blue',
            PaymentStatus::Authorized            => 'green',
            PaymentStatus::Unauthorized          => 'red',
            PaymentStatus::ProviderClaimed       => 'indigo',
            PaymentStatus::InRevision            => 'yellow',
            PaymentStatus::Processed             => 'gray',
            PaymentStatus::Confirmed             => 'green',
            PaymentStatus::Rejected              => 'red',
            PaymentStatus::CancellationInProcess => 'orange',
            PaymentStatus::Cancelled             => 'red',
            PaymentStatus::CustomerCancelled     => 'red',
            PaymentStatus::Refunded              => 'indigo',
        };
    }

    public function name(): string
    {
        return match($this)
        {
            PaymentStatus::Created               => 'Iniciado',
            PaymentStatus::TransferPending       => 'Transferencia pendiente',
            PaymentStatus::Pending               => 'Pendiente',
            PaymentStatus::NeedsConfirmation     => 'Confirmación necesaria',
            PaymentStatus::InProcess             => 'Procesando',
            PaymentStatus::Authorized            => 'Autorizado',
            PaymentStatus::Unauthorized          => 'No autorizado',
            PaymentStatus::ProviderClaimed       => 'Reclamado',
            PaymentStatus::InRevision            => 'En revisión',
            PaymentStatus::Processed             => 'Procesado',
            PaymentStatus::Confirmed             => 'Confirmado',
            PaymentStatus::Rejected              => 'Rechazado',
            PaymentStatus::CancellationInProcess => 'Cancelación en proceso',
            PaymentStatus::Cancelled             => 'Cancelado',
            PaymentStatus::CustomerCancelled     => 'Cancelado',
            PaymentStatus::Refunded              => 'Reembolsado',
        };
    }

    public function helper(): string
    {
        return match($this)
        {
            PaymentStatus::Created               => 'El comprador inició el proceso de pago pero aún no lo ha completado',
            PaymentStatus::TransferPending       => 'Se espera que el comprador envíe el comprobante de transferencia',
            PaymentStatus::Pending               => 'El comprador debe finalizar el pago',
            PaymentStatus::NeedsConfirmation     => 'Se necesita que el comprador autorize el pago del pedido',
            PaymentStatus::InProcess             => 'Esperando los resultados del pago por parte del proveedor',
            PaymentStatus::Authorized            => 'El pago fue autorizado pero aún no se ha terminado de recaudar',
            PaymentStatus::Unauthorized          => 'El pago del pedido no fue autorizado por el medio elegido',
            PaymentStatus::ProviderClaimed       => 'El comprador inició un reclamo por el pago realizado',
            PaymentStatus::InRevision            => 'El pago esta siendo revisado por el proveedor',
            PaymentStatus::Processed             => 'Se ha procesado correctamente el pago y se espera recibir detalles del mismo',
            PaymentStatus::Confirmed             => 'El pago se confirmó correctamente',
            PaymentStatus::Rejected              => 'El pago fue rechazado, el comprador puede reintenarlo',
            PaymentStatus::CancellationInProcess => 'La cancelación del pago está en proceso',
            PaymentStatus::Cancelled             => 'El pago fue cancelado',
            PaymentStatus::CustomerCancelled     => 'El pago fue cancelado por el comprador',
            PaymentStatus::Refunded              => 'Se ha reembolsado el dinero al comprador',
        };
    }

    public function customerHelper(): string
    {
        return match($this)
        {
            PaymentStatus::Created               => 'Finalizá tu compra para confirmar tu pedido',
            PaymentStatus::TransferPending       => 'Recordá adjuntar el comprobante de transferencia una vez que la realices',
            PaymentStatus::Pending               => 'Completá el pago de tu pedido para confirmarlo',
            PaymentStatus::NeedsConfirmation     => 'Debés autorizar el pago de tu pedido para confirmarlo',
            PaymentStatus::InProcess             => 'Estamos procesando tu pago, en breve actualizaremos la información',
            PaymentStatus::Authorized            => 'El pago de tu pedido fue autorizado correctamente',
            PaymentStatus::Unauthorized          => 'Tu pago no ha sido autorizado por el medio que elegiste',
            PaymentStatus::ProviderClaimed       => 'Recibimos tu reclamo por el pago de este pedido',
            PaymentStatus::InRevision            => 'El proveedor esta revisando el pago de este pedido, te notificaremos apenas recibamos actualizaciones',
            PaymentStatus::Processed             => 'Se ha procesado correctamente tu pago, en breve actualizaremos la información',
            PaymentStatus::Confirmed             => 'Tu pago ha sido confirmado',
            PaymentStatus::Rejected              => 'Tu pago ha sido rechazado, podes reintentarlo',
            PaymentStatus::CancellationInProcess => 'La cancelación del pago está en proceso',
            PaymentStatus::Cancelled             => 'El pago de tu pedido fue rechazado',
            PaymentStatus::CustomerCancelled     => 'Cancelaste el proceso de pago para este pedido',
            PaymentStatus::Refunded              => 'Se ha efectuado el reembolso de tu pago',
        };
    }
}
