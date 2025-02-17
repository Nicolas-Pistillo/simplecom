<?php 

namespace App\Enums;

enum InvoiceItemAliquot: string
{
    case IVA27       = 'iva_27';
    case IVA21       = 'iva_21';
    case IVA10_5     = 'iva_10.5';
    case IVA0        = 'iva_0';
    case IVAExempt   = 'iva_exento';
    case IVANotTaxed = 'iva_no_gravado';

    public function name(): string
    {
        return match($this)
        {
            InvoiceItemAliquot::IVA27       => '27%',
            InvoiceItemAliquot::IVA21       => '21%',
            InvoiceItemAliquot::IVA10_5     => '10.5%',
            InvoiceItemAliquot::IVA0        => '0%',
            InvoiceItemAliquot::IVAExempt   => 'IVA Exento',
            InvoiceItemAliquot::IVANotTaxed => 'IVA No gravado'
        };
    }

    public function tusfacturasValue(): string
    {
        return match($this)
        {
            InvoiceItemAliquot::IVA27       => '27',
            InvoiceItemAliquot::IVA21       => '21',
            InvoiceItemAliquot::IVA10_5     => '10.5',
            InvoiceItemAliquot::IVA0        => '0',
            InvoiceItemAliquot::IVAExempt   => '-1',
            InvoiceItemAliquot::IVANotTaxed => '-2'
        };
    }
}