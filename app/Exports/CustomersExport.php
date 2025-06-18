<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomersExport implements FromCollection, WithMapping, WithHeadings
{
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->users;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tipo de cliente',
            'Nombre',
            'Email',
            'Teléfono',
            'DNI',
            'Condición Fiscal',
            'Razón social',
            'Domicilio fiscal',
            'CUIT',
            'Suscrito a Newsletter'
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->type->name(),
            $user->full_name,
            $user->email,
            $user->phone ?? '-',
            $user->document ?? '-',
            $user->tax_condition->name(),
            !empty($user->invoice_social_reason) ? $user->invoice_social_reason : $user->full_name,
            $user->invoice_address ?? '-',
            $user->invoice_document ?? '-',
            $user->newsletter_subscribed ? 'Sí' : 'No'
        ];
    }
}
