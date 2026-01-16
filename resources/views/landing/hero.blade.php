<section id="hero" class="bg-white">
    <div class="grid max-w-screen-xl px-4 sm:px-10 pt-16 mx-auto lg:gap-8 xl:gap-0 lg:grid-cols-12">
        <div class="text-center lg:text-left place-self-center lg:col-span-7">
            <h1 class="mx-auto max-w-4xl font-display text-4xl font-medium 
            tracking-tight text-slate-900 md:text-5xl lg:text-6xl">
                Creá tu tienda online con
                <span class="relative whitespace-nowrap text-blue-600">
                    <svg aria-hidden="true" viewBox="0 0 418 42" class="absolute left-0 top-2/3 
                    h-[0.58em] w-full fill-blue-300/70" preserveAspectRatio="none">
                        <path
                            d="M203.371.916c-26.013-2.078-76.686 1.963-124.73 9.946L67.3 12.749C35.421 18.062 18.2 21.766 6.004 25.934 1.244 27.561.828 27.778.874 28.61c.07 1.214.828 1.121 9.595-1.176 9.072-2.377 17.15-3.92 39.246-7.496C123.565 7.986 157.869 4.492 195.942 5.046c7.461.108 19.25 1.696 19.17 2.582-.107 1.183-7.874 4.31-25.75 10.366-21.992 7.45-35.43 12.534-36.701 13.884-2.173 2.308-.202 4.407 4.442 4.734 2.654.187 3.263.157 15.593-.78 35.401-2.686 57.944-3.488 88.365-3.143 46.327.526 75.721 2.23 130.788 7.584 19.787 1.924 20.814 1.98 24.557 1.332l.066-.011c1.201-.203 1.53-1.825.399-2.335-2.911-1.31-4.893-1.604-22.048-3.261-57.509-5.556-87.871-7.36-132.059-7.842-23.239-.254-33.617-.116-50.627.674-11.629.54-42.371 2.494-46.696 2.967-2.359.259 8.133-3.625 26.504-9.81 23.239-7.825 27.934-10.149 28.304-14.005.417-4.348-3.529-6-16.878-7.066Z">
                        </path>
                    </svg><span class="relative">Simplecom</span></span>
            </h1>
            <p class="mx-auto my-6 max-w-4xl text-lg tracking-tight text-slate-700">
                Tu nueva solución simple e ideal para comenzar a vender en línea y en minutos,
                sin vueltas ni complicaciones.
            </p>
            <x-button href="#form" rounded size="big">Abrir mi tienda</x-button>
        </div>
        <div class="lg:mt-0 mx-auto lg:col-span-5 lg:flex">
            <img src="{{ URL::to('img/landing/hero-mockup.png') }}" class="h-full object-cover" alt="mockup">
        </div>
    </div>

    <div x-data="{}" x-init="$nextTick(() => {
        let ul = $refs.logos;
        ul.insertAdjacentHTML('afterend', ul.outerHTML);
        ul.nextSibling.setAttribute('aria-hidden', 'true');
    })"
        class="w-full mt-8 inline-flex flex-nowrap overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-128px),transparent_100%)]">
        <ul x-ref="logos"
            class="flex items-center justify-center md:justify-start [&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll">
            <li>
                <img class="w-28 h-28 object-contain" 
                src="https://zipnova.com/opengraph-image.png?b030af71241cd50d"
                alt="Zipnova" />
            </li>
            <li>
                <img class="w-28 h-28 object-contain"
                src="https://www.cedol.org.ar/logistica/wp-content/uploads/2017/12/Logo-rojo.png" 
                alt="Andreani" />
            </li>
            <li>
                <img class="w-28 h-28 object-contain"
                src="https://images.seeklogo.com/logo-png/19/1/mercadopago-logo-png_seeklogo-199533.png"
                alt="Mercado Pago" />
            </li>
            <li>
                <img class="w-28 h-28 object-contain"
                src="https://images.archbee.com/wYlzYU9oe8HZjh9BkqeFY/jF_muslOv7Tnt8AW8CVa__mobbexoriginal.png?format=webp"
                alt="Mobbex" />
            </li>
            <li>
                <img class="w-28 h-28 object-contain" 
                src="https://logosenvector.com/logo/img/modo-37330.png"
                alt="Modo" />
            </li>
            <li>
                <img class="w-28 h-10 object-contain"
                src="https://cdn.tusfacturas.app/web/images/logo-tf/2024/tusfacturasapp-isologo.png" 
                alt="Tus Facturas APP">
            </li>
            <li>
                <img class="w-28 h-10 object-contain"
                src="https://s3.us-east-005.backblazeb2.com/gocuotas-assets/assets/tile-wide-5f6cc166915fc60b7c330d6f538ad90881e7abe268dfac1f1155bbade9ba7cae.png"
                alt="Go Cuotas">
            </li>
            <li>
                <img class="w-28 h-10 object-contain"
                src="https://www.ualabis.com.ar/_next/static/media/LogoOpenGraph.d24202af.png" 
                alt="Ualabis">
            </li>
            <li>
                <img class="w-28 h-10 object-contain"
                src="https://nextiendas.com/wellcome/ayuda/data/knowledge/Env%C3%ADopack-Logo-1-negro.png"
                alt="EnvíoPack">
            </li>
        </ul>
    </div>
</section>
