<div>
    <div x-init="window.scrollTo({ top: 0, behavior: 'smooth'})">

        <h4 class="text-sm/6 font-semibold text-gray-900 mb-2">Seleccionar sucursal de retiro</h4>

        <div x-data="{panelOpen: true}"
        class="relative w-full overflow-hidden shadow-lg rounded-lg">

            {{-- GMAP --}}
            <div id="dropoff_points_map" class="ml-auto h-[320px]" 
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
                {{-- Search & Results --}}
                <div class="p-3">
                    
                </div>
            </div>
        </div>

    </div>

    {{-- @dump(session('rates_results.dropoff_rates')) --}}
    
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

        const initMap = () => 
        {
            const center = { 
                lat: {{ session('rates_results.address.lat') }}, 
                lng: {{ session('rates_results.address.lng') }}
            };

            map = new google.maps.Map(document.getElementById("dropoff_points_map"), {
                zoom: 13,
                center: center,
                mapTypeControl: false,
                scaleControl: false,
                zoomControl: false
            });

            map.addListener("click", function(event) {
                addMarker(event.latLng);
            });
        }

        // Function to add a marker to the map
        const addMarker = (location) => 
        {
            const marker = new google.maps.Marker({
                position: location,
                title: 'Algo por aca',
                map: map,
                draggable: false, // Marker can be dragged
            });

            // Store the marker in the markers array
            markers.push(marker);

            // Optional: You can add info windows or event listeners for each marker
            const infowindow = new google.maps.InfoWindow({
                content: 'Contenido del marker',
            });

            marker.addListener("click", function() {
                infowindow.open(map, marker);
            });
        }

        initMap()
    </script>
    @endscript
</div>