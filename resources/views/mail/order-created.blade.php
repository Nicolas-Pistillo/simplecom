@extends('layouts.mail.tenant')

@section('title', 'Recibimos tu pedido')

@section('mail-width', '600px')

@section('content')
    <p style="margin-bottom: 0">
        Hola {{ $order->user->name }}<br> 
        Estos son los datos del pedido que realizaste el {{ $order->created_at->format('d/m/Y') }}.
        Completa el pago para confirmarlo. ¡Muchas gracias!
    </p>

    <div role="separator" style="line-height: 31px;">&zwj;</div>

    @include('mail.partials.order-details')

    <div role="separator" style="line-height: 31px;">&zwj;</div>

    <div style="text-align: left">

        <p style="margin: 0; font-size: 12px; line-height: 16px; color: #6b7280">
            Ante cualquier consulta, podés escribirnos a travez de
            <a href="mailto:hello@example.com">hello@example.com</a>
        </p>

        <div role="separator" style="line-height: 31px;">&zwj;</div>
    </div>

    <br>
    <p style="margin: 0;font-weight: 600; text-align:center">Muchas gracias</p>
    <p style="margin: 0; font-weight: 600; text-align: center">{{ tenant('ecommerce_name') }}</p>
@endsection
