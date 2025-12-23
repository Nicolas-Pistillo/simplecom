@extends('layouts.mail.tenant')

@section('title', 'Tu pedido está listo para despachar')

@section('content')
    <p>
        Hola {{ $order->user->name }}<br> 
        Tu <a href="{{ $order->customerDetailPage() }}">pedido #{{ $order->id }}</a>
        está listo para ser despachado. Seguiremos informandote apenas recibamos actualizaciones
        del envío de tu pedido.
    </p>

    @if (!empty($order->shipping?->tracking_url))
        <p>
            <a href="{{ $order->shipping->tracking_url }}" class="btn">Seguir envío</a> <br> <br>
            <span style="color: #6b7280; font-size: 12px; text-align:center">
                También podes abrir el enlace de seguimiento copiando y pegando este link
                en tu navegador: {{ $order->shipping->tracking_url }}
            </span>
        </p>
    @endif

    <br>
    <p style="margin: 0;font-weight: 600; text-align:center">Muchas gracias</p>
    <p style="margin: 0; font-weight: 600; text-align: center">{{ tenant('ecommerce_name') }}</p>
@endsection