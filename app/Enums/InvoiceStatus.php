<?php 

namespace App\Enums;

enum InvoiceStatus: string
{
    case Pending     = 'pending';
    case Queued      = 'queued';
    case Issued      = 'issued';

    public function name(): string
    {
        return match($this)
        {
            InvoiceStatus::Pending    => 'Pendiente',
            InvoiceStatus::Queued     => 'En proceso',
            InvoiceStatus::Issued     => 'Emitida'
        };
    }

    public function color(): string
    {
        return match($this)
        {
            InvoiceStatus::Pending    => 'yellow',
            InvoiceStatus::Queued     => 'blue',
            InvoiceStatus::Issued     => 'green'
        };
    }
}