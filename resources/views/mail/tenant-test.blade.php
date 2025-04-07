@extends('layouts.mail.tenant')

@section('title', "Prueba con $tenant->ecommerce_name")

@section('content')
    <p style="margin: 0 0 24px; font-size: 16px; line-height: 24px; color: #475569">
        Esta es una prueba con el motor de plantillas default
    </p>

    <div>
        <a href="https://maizzle.com" class="btn">
            Verify email
        </a>
    </div>

    <div role="separator" style="line-height: 24px; `mso-line-height-alt: ${msoHeight}` }}">&zwj;</div>
    <p style="margin: 0; font-size: 16px; line-height: 24px; color: #475569">
        Thanks,
        <br>
        <span style="font-weight: 600">Maizzle</span>
    </p>
    <div role="separator" style="height: 1px; line-height: 1px;"> &zwj;</div>
    
    <p class="mso-break-all" style="margin: 0; font-size: 12px; line-height: 20px; color: #475569">
        If you're having trouble clicking the "Verify email" button, copy and paste the
        following URL into your web browser:
        <a href="https://maizzle.com/?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0"
            style="color: #1e293b; text-decoration: underline">https://maizzle.com/?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0</a>
    </p>
@endsection
