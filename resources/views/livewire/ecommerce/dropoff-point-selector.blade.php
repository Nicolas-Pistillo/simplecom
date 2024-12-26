<div>
    <style>
        .selected {
            border-left: 2px solid blue;
            background-color: #eff6ff;
        }
        .selected:hover {
            background-color: #eff6ff !important; 
        }
    </style>
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

                    <ul id="dropoff-options" class="no-select max-h-[300px] flow-root overflow-y-auto" scrollbar-thin>
                        @foreach (session('rates_results.dropoff_rates') as $rate)
                            @foreach ($rate->branches as $branch)
                                <li wire:key='{{ $rate->key . $branch->external_id }}' 
                                id="{{ $rate->key . $branch->external_id }}"
                                data-rate-key="{{ $rate->key }}" data-branch-id='{{ $branch->external_id }}'
                                class="relative flex items-center cursor-pointer dropoff-point
                                border-b pr-2 py-4 focus:outline-none hover:bg-gray-50">
                                    <div class="ml-3 flex items-center justify-between w-full">
                                        <div class="flex items-center text-sm">
        
                                            <div class="w-10 h-10 object-contain shadow flex items-center 
                                            justify-center rounded-xl mr-2 bg-blue-50 basis-[40px]">
                                                <x-icon code="store" class="text-blue-500" />
                                            </div>
        
                                            <div class="flex-1 gap-y-3">
                                                <h5 class="font-medium mb-1 text-xs">
                                                     {{ $branch->name }}
                                                </h5>

                                                <span class="block text-xs text-gray-700 mb-1">
                                                    {{ $branch->address->summary() }}
                                                </span>

                                                <span class="block text-xs text-green-700 font-semibold mb-1">
                                                    ${{ priceFormat($branch->price ?? $rate->price) }}
                                                </span>

                                                @if ($branch->phone)
                                                    <span class="block text-xs text-gray-700 mb-1">
                                                        {{ $branch->phone }}
                                                    </span>
                                                @endif

                                                @if ($branch->schedule)
                                                    <span class="block text-xs text-gray-700 mb-1">
                                                        Horarios: {{ $branch->schedule }}
                                                    </span>
                                                @endif

                                                <span class="block text-xs text-gray-700 mb-1">
                                                    Estimado: {{ $rate->estimate }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-2">
                                            <x-button wire:click="confirm('{{ $rate->key }}', '{{ $branch->external_id }}')" size="small">Elegir</x-button>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>

    @script
    <script>
        let map = null;
        let markers = [];

        const dropoffOptionList = document.getElementById('dropoff-options');

        const dropoffPoints = JSON.parse('{!! session('rates_results.dropoff_rates') !!}');

        const addressPosition = { 
            lat: {{ session('rates_results.address.lat') }}, 
            lng: {{ session('rates_results.address.lng') }}
        };

        const homeIcon = {
            url: '{{ URL::to('img/home-pin.png') }}',
            scaledSize: new google.maps.Size(62, 62), // scaled size
        };

        const dropoffIcon = {
            url: '{{ URL::to('img/dropoff-pin.png') }}',
            scaledSize: new google.maps.Size(60, 60), // scaled size
        };

        const initMap = () => 
        {
            /* const { AdvancedMarkerElement } = await google.maps.importLibrary("marker"); */

            map = new google.maps.Map(document.getElementById("dropoff_points_map"), {
                zoom: 14,
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

            createAddressMarker();
            createDropoffMarkers();
        }

        const createAddressMarker = () => 
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
            for(let rate of Object.values(dropoffPoints))
            {
                rate.branches.forEach((branch) => 
                {
                    const marker = new google.maps.Marker({
                        position: {
                            lat: parseFloat(branch.address.coordinates.lat),
                            lng: parseFloat(branch.address.coordinates.lng)
                        },
                        title: branch.name,
                        animation: google.maps.Animation.DROP,
                        map: map,
                        id: `${rate.key}${branch.external_id}`,
                        icon: dropoffIcon,
                        data: {rate_key: rate.key, branch_id: branch.external_id}
                    });

                    marker.addListener("click", () => selectOption(rate.key, branch.external_id));

                    markers.push(marker);
                });
            }
        }

        initMap();

        document.querySelectorAll('.dropoff-point').forEach((point) => 
        {
            point.addEventListener('click', (evt) => 
            {
                const rateKey = evt.currentTarget.dataset.rateKey;
                const branchId = evt.currentTarget.dataset.branchId;

                selectOption(rateKey, branchId);
            })
        });

        const selectOption = (rateKey, branchId) =>
        {
            const rate = Object.values(dropoffPoints).find(rate => rate.key == rateKey);
            const branch = rate.branches.find(branch => branch.external_id == branchId);

            const elementOption = document.getElementById(rateKey + branchId);

            dropoffOptionList.scrollTop = (elementOption.offsetTop - 60);

            document.querySelectorAll('.dropoff-point').forEach((point) => 
            {
                point.classList.remove('selected');
            })

            elementOption.classList.add('selected');

            map.setCenter({
                lat: parseFloat(branch.address.coordinates.lat),
                lng: parseFloat(branch.address.coordinates.lng)
            });

            map.setZoom(16);
        }
    </script>
    @endscript
</div>