@extends('layouts.mail.tenant')

@section('title', 'Pedido listo para retirar')

@section('content')
    <p style="margin-bottom: 0">
        Hola {{ $order->user->name }}<br> 
        Tu <a href="{{ $order->customerDetailPage() }}" style="font-weight: 600">
            pedido {{ $order->id }}
        </a> 
        ya se encuentra listo para retirar en <b>{{ $order->storePickup->name }}</b>.
        Podes pasar a retirarlo en el horario habitual de atención.
    </p>

    <div role="separator" style="line-height: 31px;">&zwj;</div>

    <table style="width: 100%" cellpadding="0" cellspacing="0" role="none">
        <tr>
            <td>
                <h2
                    style="margin: 0 0 8px; white-space: nowrap; font-size: 21px; line-height: 30px; font-weight: 600; color: #111827">
                    Información para retirar
                </h2>
            </td>
        </tr>
        <tr>
            <td>Dirección</td>
            <td style="padding-bottom: 4px; min-width: 230px; text-align:right">
                {{ $order->storePickup->address }}
            </td>
        </tr>

        <tr>
            <td>Horarios</td>
            <td style="padding-bottom: 4px; min-width: 230px; text-align:right">
                {{ $order->storePickup->schedule }}
            </td>
        </tr>

        @if (!empty($order->storePickup->observations))
            <tr>
                <td>Detalle</td>
                <td style="padding-bottom: 4px; min-width: 230px; text-align:right">
                    {{ $order->storePickup->observations }}
                </td>
            </tr>
        @endif
    </table>

    <br>
    <p style="margin: 0;font-weight: 600; text-align:center">Muchas gracias</p>
    <p style="margin: 0; font-weight: 600; text-align: center">{{ tenant('ecommerce_name') }}</p>
@endsection