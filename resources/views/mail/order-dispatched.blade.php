@extends('layouts.mail.tenant')

@section('title', 'Pedido despachado')

@section('content')
    <p style="margin: 0">
        Hola {{ $order->user->name }}<br>
        Te informamos que tu
        <a href="{{ $order->customerDetailPage() }}" style="font-weight: 600">
            pedido {{ $order->id }}
        </a>
        ya fue despachado y pronto estara en camino.
    </p>

    <br>
    <p style="margin: 0;font-weight: 600; text-align:center">Muchas gracias</p>
    <p style="margin: 0; font-weight: 600; text-align: center">{{ tenant('ecommerce_name') }}</p>
@endsection