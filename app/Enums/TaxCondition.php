<?php

namespace App\Enums;

enum TaxCondition: string
{
    case ConsumidorFinal = 'consumidor_final';
    case Inscripto       = 'responsable_inscripto';
    case Monotributista  = 'monotributista';
    case Exento          = 'exento';
    case NoAlcanzado     = 'iva_no_alcanzado';

    public function name(): string
    {
        return match($this)
        {
            TaxCondition::ConsumidorFinal => 'Consumidor Final',
            TaxCondition::Inscripto       => 'Responsable Inscripto',
            TaxCondition::Monotributista  => 'Monotributista',
            TaxCondition::Exento          => 'Exento',
            TaxCondition::NoAlcanzado     => 'IVA No alcanzado'
        };
    }

    public function tusfacturasValue(): string
    {
        return match($this)
        {
            TaxCondition::ConsumidorFinal => 'CF',
            TaxCondition::Inscripto       => 'RI',
            TaxCondition::Monotributista  => 'M',
            TaxCondition::Exento          => 'E',
            TaxCondition::NoAlcanzado     => 'IVNA'
        };
    }
}