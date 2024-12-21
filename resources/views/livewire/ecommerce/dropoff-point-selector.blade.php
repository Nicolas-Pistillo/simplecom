<div>
    <div x-init="window.scrollTo({ top: 0, behavior: 'smooth'})">

        <h4 class="text-sm/6 font-semibold text-gray-900 mb-2">Seleccionar sucursal de retiro</h4>

        <div class="w-full sm:w-3/4 flex-col justify-start items-start gap-1.5 flex mb-4">
            <input type="search" class="w-full focus:outline-none text-gray-900 placeholder-gray-400 
            text-sm font-normalleading-relaxed px-4 py-2 rounded-md transition duration-300
            shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] border border-gray-300" 
            placeholder="Buscar sucursal por nombre, calle, localidad etc..." autocomplete="no">
        </div>

        <div id="dropoff_points_map" class="w-full h-[320px] rounded-lg shadow-md"></div>

    </div>

    @dump(session('rates_results.dropoff_rates'))
    
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