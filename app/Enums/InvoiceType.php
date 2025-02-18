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

    public function tusfacturasValue(): string
    {
        return match($this)
        {
            InvoiceType::InvoiceA  => 'FACTURA A',
            InvoiceType::InvoiceB  => 'FACTURA B',
            InvoiceType::InvoiceC  => 'FACTURA C',
        };
    }
}