@extends('layouts.mail.tenant')

@section('title', "Código de verificación")

@section('content')

    <p>Hola {{ $recipient_name }}, este es tu código de verificación. 
    Copialo y pegalo donde se te lo haya solicitado.</p>

    <p style="font-size: 26px"><b>{{ $code }}</b></p>

    <p>
        Recordá que este código tiene una validez de hasta <b>15 minutos</b>.
        Pasado este lapso de tiempo, el código expirará.
    </p>

    <p style="text-align: center; font-size: 12px; color: #64748b">
        Si la plataforma no te solicitó ningún código de verificación o crees que se deba a un error, por favor desestima este correo.
    </p>

    <p style="text-align: center; font-size: 12px; color: #64748b">
        Muchas gracias <br />
        {{ tenant('ecommerce_name') }}
    </p>
@endsection