<section id="faqs" class="relative overflow-hidden bg-slate-50 py-24">
    <div x-data="{ selected: null }" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative">
        <div class="mx-auto max-w-2xl lg:mx-0">
            <h2 id="faq-title" class="font-display text-3xl tracking-tight text-slate-900 sm:text-4xl">
                Preguntas frecuentes
            </h2>
            <p class="mt-4 text-lg tracking-tight text-slate-700">
                Estamos para acompañarte y ayudarte en cada paso. Dejamos a continuación una serie
                de preguntas frecuentes para que despejes tus dudas o bien, podes contactarnos via email 
                para mas detalles a <b>contacto@simplecom.shop</b>
            </p>
        </div>

        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 lg:max-w-none lg:grid-cols-3">

            <div x-data="{ open: false }" class="py-6">
                <dt>
                    <button @click="open = !open" type="button"
                        class="flex items-start justify-between text-left text-gray-900">
                        <h4 class="font-display text-lg leading-7 text-slate-900">
                            ¿Cobran comisión por venta?
                        </h4>
                        <span class="ml-6 flex w-7 h-7 items-center border rounded-full 
                        border-gray-500 pl-[0.05rem]">
                            <i class="material-symbols-outlined"
                            x-text="open ? 'keyboard_arrow_up' : 'keyboard_arrow_down'"></i>
                        </span>
                    </button>
                </dt>
                <div x-cloak x-show="open" x-collapse>
                    <dd class="mt-2 pr-12">
                        <p class="mt-4 text-sm text-slate-700">
                            No, no cobramos ninguna comisión por venta realizada en tu tienda.
                            Solo abonás el valor del precio fijo mensual luego de tu periodo de prueba gratis.
                        </p>
                    </dd>
                </div>
            </div>

            <div x-data="{ open: false }" class="py-6">
                <dt>
                    <button @click="open = !open" type="button"
                        class="flex items-start justify-between text-left text-gray-900">
                        <h4 class="font-display text-lg leading-7 text-slate-900">
                            ¿Que métodos de pago ofrecen?
                        </h4>
                        <span class="ml-6 flex w-7 h-7 items-center border rounded-full 
                        border-gray-500 pl-[0.100rem]">
                            <i class="material-symbols-outlined"
                            x-text="open ? 'keyboard_arrow_up' : 'keyboard_arrow_down'"></i>
                        </span>
                    </button>
                </dt>
                <div x-cloak x-show="open" x-collapse>
                    <dd class="mt-2 pr-12">
                        <p class="mt-4 text-sm text-slate-700">
                            Podes integrar tu tienda con los principales procesadores de pago
                            como Mercado Pago, MODO, Mobbex, Ualabis, Getnet, GOcuotas etc. Ademas de poder 
                            configurar tus datos bancarios datos para recibir transferencias.
                        </p>
                    </dd>
                </div>
            </div>

            <div x-data="{ open: false }" class="py-6">
                <dt>
                    <button @click="open = !open" type="button"
                        class="flex items-start justify-between text-left text-gray-900">
                        <h4 class="font-display text-lg leading-7 text-slate-900">
                            ¿Que métodos de envío ofrecen?
                        </h4>
                        <span class="ml-6 flex w-7 h-7 items-center border rounded-full 
                        border-gray-500 pl-[0.100rem]">
                            <i class="material-symbols-outlined"
                            x-text="open ? 'keyboard_arrow_up' : 'keyboard_arrow_down'"></i>
                        </span>
                    </button>
                </dt>
                <div x-cloak x-show="open" x-collapse>
                    <dd class="mt-2 pr-12">
                        <p class="mt-4 text-sm text-slate-700">
                            En Simplecom podes cargar y configurar tus propias formas y condiciones de envío. 
                            Además ofrecemos métodos de envío con operadores como Andreani, Zipnova, Envíopack, Shipnow, E-pick, Saires, Moci's etc.
                        </p>
                    </dd>
                </div>
            </div>

            <div x-data="{ open: false }" class="py-6">
                <dt>
                    <button @click="open = !open" type="button"
                        class="flex items-start justify-between text-left text-gray-900">
                        <h4 class="font-display text-lg leading-7 text-slate-900">
                            ¿Necesito saber programar para gestionar mi tienda?
                        </h4>
                        <span class="ml-6 flex w-7 h-7 items-center border rounded-full 
                        border-gray-500 pl-[0.100rem]">
                            <i class="material-symbols-outlined"
                            x-text="open ? 'keyboard_arrow_up' : 'keyboard_arrow_down'"></i>
                        </span>
                    </button>
                </dt>
                <div x-cloak x-show="open" x-collapse>
                    <dd class="mt-2 pr-12">
                        <p class="mt-4 text-sm text-slate-700">
                            No, nosotros nos encargamos de todos los detalles técnicos necesarios para que vos solo
                            te encargues de tu operatoria. En caso de tener alguna sugerencia técnica o de diseño,
                            podes enviarla sin problema a nuestro email de soporte: <span class="text-blue-600">soporte@simplecom.shop</span>
                        </p>
                    </dd>
                </div>
            </div>

            <div x-data="{ open: false }" class="py-6">
                <dt>
                    <button @click="open = !open" type="button"
                        class="flex items-start justify-between text-left text-gray-900">
                        <h4 class="font-display text-lg leading-7 text-slate-900">
                            ¿Como van a encontrar mi tienda?
                        </h4>
                        <span class="ml-6 flex w-7 h-7 items-center border rounded-full 
                        border-gray-500 pl-[0.100rem]">
                            <i class="material-symbols-outlined"
                            x-text="open ? 'keyboard_arrow_up' : 'keyboard_arrow_down'"></i>
                        </span>
                    </button>
                </dt>
                <div x-cloak x-show="open" x-collapse>
                    <dd class="mt-2 pr-12">
                        <p class="mt-4 text-sm text-slate-700">
                            Tanto tu tienda como tu panel de administrador se crearan bajo un subdominio de simplecom.shop, por ejemplo,
                            si tu tienda se llama arcadia, tu tienda se mostrará en <span class="text-blue-600">arcadia.simplecom.shop</span>, 
                            y vas a acceder a tu panel de administrador en <span class="text-blue-600">arcadia.simplecom.shop/admin</span>.
                            También podes consultar por los costos de agregar un dominio personalizado a tu tienda.
                        </p>
                    </dd>
                </div>
            </div>

            <div x-data="{ open: false }" class="py-6">
                <dt>
                    <button @click="open = !open" type="button"
                        class="flex items-start justify-between text-left text-gray-900">
                        <h4 class="font-display text-lg leading-7 text-slate-900">
                            ¿Que limites tiene mi tienda para vender?
                        </h4>
                        <span class="ml-6 flex w-7 h-7 items-center border rounded-full 
                        border-gray-500 pl-[0.100rem]">
                            <i class="material-symbols-outlined"
                            x-text="open ? 'keyboard_arrow_up' : 'keyboard_arrow_down'"></i>
                        </span>
                    </button>
                </dt>
                <div x-cloak x-show="open" x-collapse>
                    <dd class="mt-2 pr-12">
                        <p class="mt-4 text-sm text-slate-700">
                            Ninguno, con Simplecom podes vender sin limites de almacenamiento, ventas o de productos.
                        </p>
                    </dd>
                </div>
            </div>
        </div>
    </div>
</section>
