@extends('layouts.mail.simplecom')

@section('title', 'Nuevo comercio interesado')

@section('content')
    <table>
        <tr>
            <td><b>Datos ingresados del comercio</b></td>
        </tr>
        <tr>
            <td>
                Nombre del comercio: {{ $form->ecommerce_name }}
            </td>
        </tr>
        <tr>
            <td>
                Razón social: {{ $form->social_reason }}
            </td>
        </tr>
        <tr>
            <td>
                CUIT: {{ $form->invoice_document }}
            </td>
        </tr>
        <tr>
            <td>
                Condición fiscal: {{ TaxCondition::tryFrom($form->tax_condition)->name() }}
            </td>
        </tr>
        <tr>
            <td>
                Rubro: {{ App\Models\Sector::find($form->sector)->name }}
            </td>
        </tr>
        <tr>
            <td>
                Domicilio fiscal: {{ $form->invoice_address }}
            </td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
            <td><b>Persona interesada</b></td>
        </tr>
        <tr>
            <td>
                Nombre: {{ $form->operator_name }}
            </td>
        </tr>
        <tr>
            <td>
                Email: {{ $form->operator_email }}
            </td>
        </tr>
        <tr>
            <td>
                Teléfono: {{ $form->operator_phone }}
            </td>
        </tr>
    </table>
@endsection