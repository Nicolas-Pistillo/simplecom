@extends('layouts.mail.simplecom')

@section('title', "Te damos la bienvenida a Simplecom")

@section('content')
    <p>
        Hola <b>{{ $tenant->ecommerce_name }}</b>, muchas gracias por elegirnos.
        Tu tienda ya se encuentra activada y solo falta que ingreses a tu panel de administración 
        para que comiences a configurla.
        <br> <br>
        Tus datos para iniciar sesión son los siguientes: <br> <br>
        <b>Email:</b> {{ $operator->email }} <br>
        <b>Contraseña:</b> {{ $password }} <br>
        <div>
            <a href="{{ env('APP_SCHEME') }}://{{ $tenant->domain() }}/admin" class="btn">
                Ingresar al panel
            </a>
        </div>
    </p>

    <br>

    <p>
        Dejamos a tu disposición el
        <a href="#">instructivo de uso</a> y quedamos atentos a cualquier inquietud que puedas tener.
    </p>

    <br>

    <p style="font-size: 14px; font-weight: 600">
        Esperamos poder acompañarte en el crecimiento de tu negocio <br>
        El equipo de Simplecom
    </p>    
@endsection