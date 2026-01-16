<footer class="bg-slate-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="py-16">
            <img src="{{ asset('img/simplecom/png/logo-color.png') }}" alt="Logo img"
                class="mx-auto h-32 sm:h-36 rounded-full w-auto shadow-md" />

            <nav class="mt-10 text-sm" aria-label="quick links">
                <div class="-my-1 flex justify-center gap-x-6">
                    <a href="#features"
                        class="inline-block rounded-lg px-2 py-1 text-sm 
                        text-slate-700 hover:bg-slate-100 hover:text-slate-900">
                        Características
                    </a>

                    <a href="#benefits"
                        class="inline-block rounded-lg px-2 py-1 text-sm 
                    text-slate-700 hover:bg-slate-100 hover:text-slate-900">
                        Beneficios
                    </a>

                    <a href="#pricing"
                        class="inline-block rounded-lg px-2 py-1 text-sm 
                    text-slate-700 hover:bg-slate-100 hover:text-slate-900">
                        Precio
                    </a>
                </div>
            </nav>
        </div>
        <div class="flex flex-col md:flex-row justify-between items-center 
        border-t border-slate-400/10 py-10 gap-y-10 gap-x-4">
            <div class="flex flex-col text-sm text-slate-500">
                <p>Contacto: <b>{{ env('SC_MAIL_CONTACT') }}</b></p>
                <p>Soporte clientes: <b>{{ env('SC_MAIL_SUPPORT') }}</b> </p>
                <p>
                    Teléfono: 
                    <a target="_blank" class="text-blue-600 underline" 
                    href="https://api.whatsapp.com/send?phone=5491169755391">
                        +54 9 116975-5391
                    </a> 
                </p>
            </div>
            <p class="text-sm text-slate-500">
                Copyright © 2026 Simplecom. Todos los derechos reservados.
            </p>
        </div>
    </div>
</footer>
