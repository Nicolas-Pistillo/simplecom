@extends('layouts.mail.tenant')

@section('title', 'Pedido confirmado')
    
@section('content')

    <p style="margin: 0">
        Hola {{ $order->user->name }}<br>
        Tu pedido fue confirmado y estará siendo preparado a la brevedad.
        Recordá que podes consultar su
        <a href="{{ $order->customerDetailPage() }}">
            estado y detalles 
        </a>
        cuando desees.
    </p>

    <div role="separator" style="line-height: 31px;">&zwj;</div>
    @include('mail.partials.order-details')
    <br>
    <p style="margin: 0;font-weight: 600; text-align:center">Muchas gracias</p>
    <p style="margin: 0; font-weight: 600; text-align: center">{{ tenant('ecommerce_name') }}</p>
@endsection