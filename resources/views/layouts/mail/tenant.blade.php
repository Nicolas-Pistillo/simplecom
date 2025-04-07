<!DOCTYPE html>
<html lang="es" xmlns:v="urn:schemas-microsoft-com:vml">

<head>
    <meta charset="utf-8">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no, url=no">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    @php
        tenancy()->initialize($tenant);
        $tenantColor = getRawColor($tenant->color);
    @endphp
    <style>
        .hover-bg-slate-800:hover {
            background-color: #1e293b !important;
        }

        @media (max-width: 600px) {
            .sm-p-6 {
                padding: 24px !important;
            }

            .sm-px-4 {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }

            .sm-px-6 {
                padding-left: 24px !important;
                padding-right: 24px !important;
            }
        }
    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', Arial, sans-serif !important;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            padding: 16px 24px;
            font-size: 16px;
            line-height: 1;
            border-radius: 4px;
            color: #fffffe;
            background-color: {{ $tenantColor }};
        }
    </style>
</head>

<body style="font-family: 'Poppins', Arial, sans-serif; margin: 0; width: 100%; background-color: #f8fafc; padding: 0; -webkit-font-smoothing: antialiased; word-break: break-word">
    <div role="article" aria-roledescription="email" aria-label lang="en">
        <div class="sm-px-4" style="background-color: #f8fafc">
            <table align="center" style="margin: 0 auto; font-family: Poppins, sans-serif" cellpadding="0"
                cellspacing="0" role="none">
                <tr>
                    <td style="width: 552px; max-width: 100%">
                        <div role="separator" style="line-height: 24px; `mso-line-height-alt: ${msoHeight}` }}">&zwj;
                        </div>
                        <table style="width: 100%" cellpadding="0" cellspacing="0" role="none">
                            <tr>
                                <td class="sm-p-6"
                                    style="border-radius: 8px; background-color: #fffffe; padding: 24px 36px; border: 1px solid #e2e8f0">
                                    <a href="{{ route('ecommerce.index') }}">
                                        <img src="{{ tenant()->logo() }}" width="180" alt="Maizzle"
                                            style="max-width: 100%; vertical-align: middle">
                                    </a>
                                    <div role="separator" style="line-height: 24px; `mso-line-height-alt: ${msoHeight}` }}">&zwj;</div>

                                    <h1 style="margin: 0 0 24px; font-size: 24px; line-height: 32px; font-weight: 600; color: #0f172a">
                                        @yield('title')
                                    </h1>

                                    @yield('content')
                                </td>
                            </tr>
                        </table>
                        <table style="width: 100%" cellpadding="0" cellspacing="0" role="none">
                            <tr>
                                <td class="sm-px-6" style="padding: 24px 36px">
                                    <p style="margin: 0; text-align: center; font-size: 12px; color: #64748b">
                                        Desarrollado por
                                        <a href="{{ route('simplecom.landing') }}">Simplecom</a> &copy;
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
