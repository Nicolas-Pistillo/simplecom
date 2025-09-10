<?php

namespace App\Enums;

enum ZipcodeSelectionType: string
{
    case ByRanges      = 'by_ranges';
    case FreeSelection = 'free_selection';

    public function name(): string
    {
        return match($this)
        {
            self::ByRanges    => 'Definir rangos',
            self::FreeSelection  => 'Seleccion libre'
        };
    }
}