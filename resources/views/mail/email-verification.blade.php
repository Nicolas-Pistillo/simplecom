<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Email Verification</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="flex items-center justify-center flex-col mt-5">

        <section class="max-w-2xl bg-white">

            <header class="p-5 text-center">
                <a href="http://{{ tenant()->domain() }}">
                    <img src="{{ tenant()->logo() }}" class="h-16 mx-auto" alt="{{ tenant('ecommerce_name') }} logo" />
                </a>
            </header>

            <div class="bg-{{ tenant('color') }}-600 px-5 py-8 w-full text-white flex 
            items-center justify-center flex-col gap-5">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-px bg-white"></div>

                    <x-icon code="mail" style="font-size: 20px" />

                    <div class="w-10 h-px bg-white"></div>
                </div>
                <div class="flex flex-col gap-5">

                    <div class="text-center text-sm font-normal">
                        ¡Gracias por registrarte!
                    </div>

                    <div class="text-2xl font-semibold capitalize text-center">
                        Confirmación de correo
                    </div>
                </div>
            </div>

            <main scrollbar-thin class="mt-8 px-5">

                <h4 class="font-semibold text-gray-800">Hola, {{ $recipient_name }}</h4>

                <p class="leading-6 text-gray-600">
                    Este es tu código de verificación de email para {{ tenant('ecommerce_name') }},
                    copialo y pegalo donde se te lo solicite.
                </p>

                <div class="flex items-center gap-3 mt-4 text-sm">
                    <h5 class="text-blue-600 font-semibold text-2xl tracking-widest">{{ $code }}</h5>
                </div>

                <p class="mt-4 leading-7 text-gray-600">
                    Recordá que este código tiene una validez de hasta
                    <span class="font-semibold">15 minutos</span>. 
                    Pasado este lapso de tiempo, el código expirará.
                </p>

                <p class="mt-8 text-gray-600">
                    Muchas gracias, <br />
                    El equipo de {{ tenant('ecommerce_name') }}
                </p>
            </main>

            <p class="text-gray-600 px-5 mt-8 text-xs text-center">
                Si la plataforma no te solicitó ningún código de verificación o crees que se deba a un error, por favor desestima este correo.
            </p>

            <footer class="mt-8">

                @php
                    $fisicalAddress     = tenant()->configValue('fisical_address');
                    $attentionSchedule  = tenant()->configValue('attention_schedule');
                    $contactEmail       = tenant()->configValue('contact_email');
                    $contactWhatsapp    = tenant()->configValue('contact_whatsapp');
                @endphp

                <div class="bg-gray-100 text-gray-700 flex flex-col justify-center items-center gap-5 py-4">

                    <div class="text-center flex flex-col gap-3 px-5">

                        <h1 class="font-semibold text-xl tracking-wider">
                            {{ tenant('ecommerce_name') }}
                        </h1>
                        
                        @if (!empty($fisicalAddress))
                            <span class="text-gray-600 text-sm">{{ $fisicalAddress }}</span>
                        @endif

                        @if (!empty($attentionSchedule))
                            <span class="text-gray-600 text-sm">
                                Horarios de atención: {{ $attentionSchedule }}
                            </span>
                        @endif

                        @if (!empty($contactEmail))
                            <a href="mailto:{{ $contactEmail }}" class="text-gray-600 text-sm">
                                Email: {{ $contactEmail }}
                            </a>                            
                        @endif

                        @if (!empty($contactWhatsapp))
                            <a href="https://api.whatsapp.com/send/?phone={{ $contactWhatsapp }}" class="text-gray-600 text-sm">
                                Whatsapp: {{ $contactWhatsapp }}
                            </a>                            
                        @endif

                    </div>

                    <div class="flex items-center justify-center gap-3 px-3">
                        <a href="#_">
                            <svg stroke="currentColor" fill="gray" stroke-width="0" viewBox="0 0 16 16"
                                height="18" width="18" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z">
                                </path>
                            </svg>
                        </a>
                        <a href="#_">
                            <svg stroke="currentColor" fill="gray" stroke-width="0" viewBox="0 0 1024 1024"
                                height="18" width="18" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M512 378.7c-73.4 0-133.3 59.9-133.3 133.3S438.6 645.3 512 645.3 645.3 585.4 645.3 512 585.4 378.7 512 378.7zM911.8 512c0-55.2.5-109.9-2.6-165-3.1-64-17.7-120.8-64.5-167.6-46.9-46.9-103.6-61.4-167.6-64.5-55.2-3.1-109.9-2.6-165-2.6-55.2 0-109.9-.5-165 2.6-64 3.1-120.8 17.7-167.6 64.5C132.6 226.3 118.1 283 115 347c-3.1 55.2-2.6 109.9-2.6 165s-.5 109.9 2.6 165c3.1 64 17.7 120.8 64.5 167.6 46.9 46.9 103.6 61.4 167.6 64.5 55.2 3.1 109.9 2.6 165 2.6 55.2 0 109.9.5 165-2.6 64-3.1 120.8-17.7 167.6-64.5 46.9-46.9 61.4-103.6 64.5-167.6 3.2-55.1 2.6-109.8 2.6-165zM512 717.1c-113.5 0-205.1-91.6-205.1-205.1S398.5 306.9 512 306.9 717.1 398.5 717.1 512 625.5 717.1 512 717.1zm213.5-370.7c-26.5 0-47.9-21.4-47.9-47.9s21.4-47.9 47.9-47.9 47.9 21.4 47.9 47.9a47.84 47.84 0 0 1-47.9 47.9z">
                                </path>
                            </svg>
                        </a>
                        <a href="#_">
                            <svg stroke="currentColor" fill="gray" stroke-width="0" viewBox="0 0 16 16"
                                height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z">
                                </path>
                            </svg>
                        </a>
                    </div>

                </div>

                <div class="bg-blue-600 text-center text-white">
                    <p class="text-xs py-2">
                        © 2024 Desarrollado por 
                        <a class="underline" href="{{ route('simplecom.landing') }}">Simplecom</a>
                    </p>
                </div>
            </footer>
        </section>
    </div>
</body>

</html>
