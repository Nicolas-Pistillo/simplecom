<div>
    <div x-init="window.scrollTo({ top: 0, behavior: 'smooth'})">

        <h4 class="text-sm/6 font-semibold text-gray-900 mb-2">Seleccionar sucursal de retiro</h4>

        <div x-data="{panelOpen: true}"
        class="relative w-full overflow-hidden shadow-lg rounded-lg">

            {{-- GMAP --}}
            <div id="dropoff_points_map" class="ml-auto h-[360px]" 
            :class="panelOpen ? 'w-5/12 sm:w-1/2' : 'w-full'"></div>

            {{-- Search Panel --}}
            <div x-cloak class="absolute top-0 left-0 w-7/12 sm:w-1/2 h-full bg-white duration-300"
            :class="panelOpen ? 'transform translate-x-0' : 'transform -translate-x-full'">
                {{-- Open/Close toggle --}}
                <div class="relative">
                    <div @click="panelOpen = !panelOpen" 
                    x-tooltip.placement.right="panelOpen ? 'Cerrar panel' : 'Abrir panel'"
                    class="absolute cursor-pointer w-8 h-10 flex items-center rounded-br-lg
                    justify-center top-0 right-[-32px] bg-gray-50 shadow-lg">
                        <i class="material-symbols-outlined text-sm text-gray-700 ml-1"
                        x-text="panelOpen ? 'arrow_back_ios' : 'arrow_forward_ios'"></i>
                    </div>
                </div>
                {{-- Search Box & Results --}}
                <div>
                    <div class="p-3">
                        <input type="search" placeholder="Buscar por nombre o dirección..."
                        class="block w-full rounded-md border-gray-300 
                        shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>

                    <ul class="no-select max-h-[300px] flow-root overflow-y-auto" scrollbar-thin>
                        @foreach (session('rates_results.dropoff_rates') as $rate)
                            @foreach ($rate->branches as $rate_branch)
                                <li wire:key='{{ $rate->key }}' data-branch='{!! json_encode($rate_branch) !!}'                                class="relative flex items-center cursor-pointer dropoff-point
                                border-b pr-2 py-4 focus:outline-none hover:bg-gray-50">
                                    <div class="ml-3 flex items-center justify-between w-full">
                                        <div class="flex items-center text-sm">
        
                                            <div class="w-10 h-10 object-contain shadow flex items-center 
                                            justify-center rounded-xl mr-2 bg-blue-50 basis-[40px]">
                                                <x-icon code="store" class="text-blue-500" />
                                            </div>
        
                                            <div class="flex-1">
                                                <h5 class="font-medium mb-0.5 text-xs">
                                                     {{ $rate_branch->name }}
                                                </h5>

                                                <span class="block text-xs text-gray-700 mb-1">
                                                    {{ $rate_branch->address->summary() }}
                                                </span>

                                                <span class="block text-xs text-green-700 font-semibold">
                                                    ${{ priceFormat($rate_branch->price ?? $rate->price) }}
                                                </span>

                                                @if ($rate_branch->phone)
                                                    <span class="block text-xs text-gray-700">
                                                        {{ $rate_branch->phone }}
                                                    </span>
                                                @endif

                                                @if ($rate_branch->schedule)
                                                    <span class="block text-xs text-gray-700">
                                                        Horarios: {{ $rate_branch->schedule }}
                                                    </span>
                                                @endif

                                                <span class="block text-xs text-gray-700">
                                                    Estimado: {{ $rate->estimate }}
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <x-button size="small">Elegir</x-button>
                                        </div>
                                    </div>
                                    {{-- @dump($rate_branch) --}}
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>

    {{-- @dump(session('rates_results.dropoff_rates.7')) --}}
    
    <div wire:loading.remove wire:target='selectAddress' class="flex items-center gap-3 mt-8">
    
        <x-button wire:click='$parent.hideDropoffSelection' type="soft" 
        :disabled="false" size="big" class="!shadow">
            Volver
        </x-button>
    
        <x-button wire:click='summaryStep' :disabled="true" size="big">
            Continuar
        </x-button>
    </div>

    @script
    <script>
        let map = null;
        let markers = [];

        const dropoffPoints = JSON.parse('{!! session('rates_results.dropoff_rates') !!}');

        const addressPosition = { 
            lat: {{ session('rates_results.address.lat') }}, 
            lng: {{ session('rates_results.address.lng') }}
        };

        const homeIcon = {
            url: '{{ URL::to('img/home-pin.png') }}',
            scaledSize: new google.maps.Size(50, 50), // scaled size
        };

        const dropoffIcon = {
            url: '{{ URL::to('img/dropoff-pin.png') }}',
            scaledSize: new google.maps.Size(50, 50), // scaled size
        };

        const initMap = () => 
        {
            /* const { AdvancedMarkerElement } = await google.maps.importLibrary("marker"); */

            map = new google.maps.Map(document.getElementById("dropoff_points_map"), {
                zoom: 13,
                center: addressPosition,
                mapTypeControl: false,
                scaleControl: false,
                zoomControl: false,
                styles: [
                {
                    featureType: "poi",
                    stylers: [{ visibility: "off" }],
                }]
            });

            createUserMarker();
            createDropoffMarkers();
        }

        const createUserMarker = () => 
        {
            const userMarker = new google.maps.Marker({
                position: addressPosition,
                map: map,
                icon: homeIcon,
                title: 'Dirección seleccionada'
            });

            const infoWindow = new google.maps.InfoWindow({
                headerContent: 'Dirección seleccionada',
                content: '{{ session('rates_results.address.summary') }}'
            });

            userMarker.addListener('click', () => infoWindow.open(map, userMarker));
            markers.push(userMarker);
        }

        const createDropoffMarkers = () => 
        {
            for(let point of Object.values(dropoffPoints))
            {
                point.branches.forEach((branch) => 
                {
                    const marker = new google.maps.Marker({
                        position: {
                            lat: parseFloat(branch.address.coordinates.lat),
                            lng: parseFloat(branch.address.coordinates.lng)
                        },
                        title: 'Punto de retíro',
                        animation: google.maps.Animation.DROP,
                        map: map,
                        icon: dropoffIcon,
                        data: {result: true, marker: branch.external_id}
                    });

                    marker.addListener("click", function() {
                        console.log(marker.data);
                    });

                    markers.push(marker);
                });
            }
        }

        initMap();

        document.querySelectorAll('.dropoff-point').forEach((point) => 
        {
            point.addEventListener('click', (evt) => 
            {
                const branch = JSON.parse(evt.currentTarget.dataset.branch);

                map.setCenter({
                    lat: parseFloat(branch.address.coordinates.lat),
                    lng: parseFloat(branch.address.coordinates.lng)
                });
            })
        });
    </script>
    @endscript
</div>