<?php

namespace App\Enums;

enum InvoiceType: string
{
    case InvoiceA = 'invoice_a';
    case InvoiceB = 'invoice_b';
    case InvoiceC = 'invoice_c';

    public function name(): string
    {
        return match($this)
        {
            InvoiceType::InvoiceA  => 'Factura A',
            InvoiceType::InvoiceB  => 'Factura B',
            InvoiceType::InvoiceC  => 'Factura C',
        };
    }
}