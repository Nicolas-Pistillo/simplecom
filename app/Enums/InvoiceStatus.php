<?php 

namespace App\Enums;

enum InvoiceStatus: string
{
    case NotCreated  = 'not_created';
    case Pending     = 'pending';
    case Queued      = 'queued';
    case Issued      = 'issued';

    public function name(): string
    {
        return match($this)
        {
            InvoiceStatus::NotCreated => 'No creada',
            InvoiceStatus::Pending    => 'Pendiente',
            InvoiceStatus::Queued     => 'En proceso',
            InvoiceStatus::Issued     => 'Emitida'
        };
    }

    public function color(): string
    {
        return match($this)
        {
            InvoiceStatus::NotCreated => 'gray',
            InvoiceStatus::Pending    => 'yellow',
            InvoiceStatus::Queued     => 'blue',
            InvoiceStatus::Issued     => 'green'
        };
    }
}