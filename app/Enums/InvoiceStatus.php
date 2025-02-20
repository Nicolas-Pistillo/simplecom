<?php 

namespace App\Enums;

enum InvoiceStatus: string
{
    case Pending = 'pending';
    case Queued  = 'queued';
    case Issued  = 'issued';

    public function name(): string
    {
        return match($this)
        {
            InvoiceStatus::Pending => 'Pendiente',
            InvoiceStatus::Queued  => 'Emitiendo',
            InvoiceStatus::Issued  => 'Emitida'
        };
    }

    public function color(): string
    {
        return match($this)
        {
            InvoiceStatus::Pending => 'yellow',
            InvoiceStatus::Queued  => 'blue',
            InvoiceStatus::Issued  => 'green'
        };
    }

    public function helper(): string
    {
        return match($this)
        {
            InvoiceStatus::Pending => 'El proveedor emitirá la factura en breve',
            InvoiceStatus::Queued  => 'El proveedor ya está emitiendo la factura',
            InvoiceStatus::Issued  => 'La factura ha sido emitida correctamente'
        };
    }
}