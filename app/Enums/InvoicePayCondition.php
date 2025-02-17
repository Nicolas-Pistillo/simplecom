<?php

namespace App\Enums;

enum InvoicePayCondition: string
{
    case Cash         = 'cash';
    case CurrentCount = 'current_count';
    case BankTransfer = 'bank_transfer';
    case CreditCard   = 'credit_card';
    case DebitCard    = 'debit_card';
    case Others       = 'others';

    public function name(): string
    {
        return match($this)
        {
            InvoicePayCondition::Cash          => 'Contado',
            InvoicePayCondition::CurrentCount  => 'Cuenta corriente',
            InvoicePayCondition::BankTransfer  => 'Transferencia bancaria',
            InvoicePayCondition::CreditCard    => 'Tarjeta de crédito',
            InvoicePayCondition::DebitCard     => 'Tarjeta de débito',
            InvoicePayCondition::Others        => 'Otros',
        };
    }

    public function tusfacturasValue(): string
    {
        return match($this)
        {
            InvoicePayCondition::Cash          => '201',
            InvoicePayCondition::CurrentCount  => '205',
            InvoicePayCondition::BankTransfer  => '210',
            InvoicePayCondition::CreditCard    => '211',
            InvoicePayCondition::DebitCard     => '212',
            InvoicePayCondition::Others        => '214'
        };
    }
}