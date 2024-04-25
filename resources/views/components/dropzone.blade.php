<div x-data="dropzone()" @click="document.getElementById('file-upload-input').click()"
    @dragenter.prevent="dragEntered = true" @dragover.prevent="dragEntered = true" @dragleave.prevent="dragEntered = false"
    @drop.prevent="dragEntered = false; handleDropEvent($event)"
    @uploaddropped.window="loadingDroppedFiles = true;
    $wire.upload('{{ $model }}', $event.detail, (results) => loadingDroppedFiles = false)"
    class="cursor-pointer flex justify-center rounded-lg border border-dashed px-6 py-8 mb-2 relative"
    :class="dragEntered ? 'border-blue-600' : 'border-gray-400/70'">

    <div class="text-center py-2">

        <i x-text="dragEntered ? 'place_item' : 'photo_library'"
        :class="dragEntered ? 'text-blue-600/70' : 'text-gray-400'" class="material-symbols-outlined text-4xl"></i>

        <div class="flex text-sm leading-6 text-gray-600">
            <p class="pl-1 w-full text-center"
                x-text="dragEntered ? 'Soltá tus archivos para subirlos' : '{{ $label ?? 'Selecciona o arrastra tus imágenes acá' }}'">
            </p>
        </div>

        <p class="text-xs leading-5 text-gray-600" :class="dragEntered ? 'opacity-0' : 'opacity-100'">
            {{ $placeholder ?? 'Solo formatos PNG o JPG de hasta 4MB' }}
        </p>

        <input wire:model='{{ $model }}' accept="image/jpeg, image/png" id="file-upload-input" type="file" class="sr-only">
    </div>

    {{-- Dropped files loader --}}
    <div x-show="loadingDroppedFiles" x-cloak class="h-6 w-full absolute bottom-2">
        <x-spinner />
    </div>

    {{-- Simple upload loader --}}
    <div wire:loading wire:target='{{ $model }}' class="h-6 w-full absolute bottom-2">
        <x-spinner />
    </div>
</div>

<script>
    const dropzone = () =>
    {
        return {
            dragEntered: false,
            loadingDroppedFiles: false,
            handleDropEvent: (event) => {

                const files = event.dataTransfer.files;
                
                if (!files.length) return;

                const validImageTypes = ['image/jpeg', 'image/png'];

                Array.from(files).forEach(file => 
                {
                    if (!validImageTypes.includes(file.type)) return;

                    if (file.size >= 4000000) return;

                    window.dispatchEvent(new CustomEvent('uploaddropped', {detail: file}))
                })
            }
        }
    }
</script>
