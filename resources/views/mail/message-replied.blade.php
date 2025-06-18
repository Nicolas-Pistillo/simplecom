@extends('layouts.mail.tenant')

@section('title', 'Respuesta a tu mensaje')
    
@section('content')

    <p style="margin: 0">
        <small style="font-weight: 800">
            {{ $messageModel->reply }}
        </small>
    </p>
    <br>
    <div>
        <small>Tu mensaje: {{ $messageModel->message }}</small>
    </div>

    <div role="separator" style="line-height: 31px;">&zwj;</div>
    <br>
    <p style="margin: 0; font-weight: 600; text-align: center">{{ tenant('ecommerce_name') }}</p>
@endsection