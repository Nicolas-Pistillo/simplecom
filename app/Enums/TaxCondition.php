<?php

namespace App\Enums;

enum TaxCondition: string
{
    case ConsumidorFinal = 'consumidor_final';
    case Inscripto       = 'responsable_inscripto';
    case Monotributista  = 'monotributista';

    public static function toArray(): array
    {
        return [
            self::ConsumidorFinal->value,
            self::Inscripto->value,
            self::Monotributista->value
        ];
    }

    public function name(): string
    {
        return match($this)
        {
            TaxCondition::ConsumidorFinal => 'Consumidor Final',
            TaxCondition::Inscripto       => 'Responsable Inscripto',
            TaxCondition::Monotributista  => 'Monotributista'
        };
    }

    public function tusfacturasValue(): string
    {
        return match($this)
        {
            TaxCondition::ConsumidorFinal => 'CF',
            TaxCondition::Inscripto       => 'RI',
            TaxCondition::Monotributista  => 'M'
        };
    }

    public static function needsInvoiceA($tax_condition)
    {
        return in_array($tax_condition, [self::Inscripto->value, self::Monotributista->value]);
    }
}