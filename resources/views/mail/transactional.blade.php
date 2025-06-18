@extends('layouts.mail.simplecom')

@section('title', 'Actualización de correo')

@section('content')
    <p style="margin: 0 0 24px; font-size: 16px; line-height: 24px; color: #475569">
        We're happy to have you on board! Please verify your email address in order to
        activate your account:
    </p>

    <div>
        <a href="https://maizzle.com" class="btn">
            Verify email
        </a>
    </div>

    <div role="separator" style="line-height: 24px;">&zwj;</div>

    <p style="margin: 0; font-size: 16px; line-height: 24px; color: #475569">
        Gracias <br> <span style="font-weight: 600">El equipo de Simplecom</span>
    </p>

    <br>

    <p class="mso-break-all" style="margin: 0; font-size: 12px; line-height: 20px; color: #475569">
        If you're having trouble clicking the "Verify email" button, copy and paste the
        following URL into your web browser:
        <a href="https://maizzle.com/?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0"
        style="color: #1e293b; text-decoration: underline">https://maizzle.com/?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0</a>
    </p>
@endsection
