<div x-data="{ showConfirmInvoice: false }" class="rounded-lg bg-gray-50 shadow-sm ring-1 ring-gray-900/5 py-6 px-4">
    <div class="pb-3 border-b">

        <div class="flex justify-between items-center text-sm/6 
        font-semibold text-gray-900 mb-1.5">

            <span class="mt-1 text-base font-semibold text-gray-900">
                Factura
            </span>

            @if (!$order->invoice)
                <x-badge>No creada</x-badge>
            @else
            @endif
        </div>

        <small>Todavía no emitiste la factura</small>
    </div>

    {{-- <div class="w-full pt-3">

        <div class="mb-3">
            <dt class="text-xs text-gray-500">
                Nro de comprobante
            </dt>
            <dd class="text-sm/6 font-medium text-gray-700">
                004566985
            </dd>
        </div>

        <div class="mb-3">
            <dt class="text-xs text-gray-500">
                Fecha de creación
            </dt>
            <dd class="text-sm/6 font-medium text-gray-700">
                12/02/2025 16:30
            </dd>
        </div>

        <div class="mb-3">
            <dt class="text-xs text-gray-500">
                Fecha de emisión
            </dt>
            <dd class="text-sm/6 font-medium text-gray-700">
                14/02/2025 08:00
            </dd>
        </div>

        <div class="flex flex-wrap gap-6">
            <div class="flex flex-col">
                <dt class="text-xs text-gray-500">
                    Teléfono
                </dt>
                <dd class="text-sm font-medium text-gray-700">
                    {{ $order->user->phone }}
                </dd>
            </div>

            <div class="flex flex-col">
                <dt class="text-xs text-gray-500">
                    DNI
                </dt>
                <dd class="text-sm font-medium text-gray-700">
                    {{ $order->user->document }}
                </dd>
            </div>
        </div> 

    </div> --}}

    <div class="pt-3">
        <x-button @click="showConfirmInvoice = true" type="secondary">Emitir factura</x-button>
    </div>

    <x-modal ref="showConfirmInvoice" title="Nueva Factura" icon="description">
        <x-slot name="body">
            <span>Se generará una nueva factura asociada al pedido</span>

            <div>
                <div class="flex items-center gap-4 mt-3.5">

                    <div class="relative mb-5">
                        <label class="flex  items-center mb-1 text-gray-600 text-xs font-medium">
                            Tipo de factura
                        </label>
                        <select type="text"
                        class="block w-full max-w-xs pl-4 pr-3.5 py-2 text-sm font-normal shadow-xs 
                        text-gray-900 bg-transparent border border-gray-300 rounded-lg 
                        focus:outline-none leading-relaxed">
                            <option>Factura A</option>
                            <option selected>Factura B</option>
                            <option>Factura C</option>
                        </select>
                    </div>
    
                    <div class="relative mb-5">
                        <label class="flex  items-center mb-1 text-gray-600 text-xs font-medium">
                            Alicuota
                        </label>
                        <select type="text"
                        class="block w-full max-w-xs pl-4 pr-3.5 py-2 text-sm font-normal shadow-xs 
                        text-gray-900 bg-transparent border border-gray-300 rounded-lg 
                        focus:outline-none leading-relaxed">
                            <option value="27">27%</option>
                            <option value="21" selected>21%</option>
                            <option value="10.5">%10.5</option>
                            <option value="0">%0</option>
                            <option value="-1">IVA Exento</option>
                            <option value="-2">IVA No gravado</option>
                        </select>
                    </div>
                </div>
    
                <div class="relative mb-5">
                    <label class="flex  items-center mb-1 text-gray-600 text-xs font-medium">
                        Tu rubro
                    </label>
                    <div class="relative  text-gray-500 focus-within:text-gray-900">
                        <input type="text"
                        class="block w-full py-2 text-sm text-ellipsis
                        font-normal shadow-xs text-gray-900 bg-transparent border 
                        border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none 
                        leading-relaxed" value="{{ tenant()->sector->name }}">
                    </div>
                </div>
    
                {{-- <div class="relative mb-3.5">
                    <label class="flex  items-center mb-1 text-gray-600 text-xs font-medium">Date
                    </label>
                    <div class="relative  text-gray-500 focus-within:text-gray-900 ">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                fill="none">
                                <path
                                    d="M12.75 3.375L12.75 3.975L12.75 3.375ZM5.24999 3.37502L5.24999 2.77502L5.24999 3.37502ZM6.03809 11.1C6.36946 11.1 6.63809 10.8314 6.63809 10.5C6.63809 10.1686 6.36946 9.9 6.03809 9.9V11.1ZM6.00059 9.9C5.66921 9.9 5.40059 10.1686 5.40059 10.5C5.40059 10.8314 5.66921 11.1 6.00059 11.1V9.9ZM6.03809 13.35C6.36946 13.35 6.63809 13.0814 6.63809 12.75C6.63809 12.4186 6.36946 12.15 6.03809 12.15V13.35ZM6.00059 12.15C5.66921 12.15 5.40059 12.4186 5.40059 12.75C5.40059 13.0814 5.66921 13.35 6.00059 13.35V12.15ZM9.03809 11.1C9.36946 11.1 9.63809 10.8314 9.63809 10.5C9.63809 10.1686 9.36946 9.9 9.03809 9.9V11.1ZM9.00059 9.9C8.66921 9.9 8.40059 10.1686 8.40059 10.5C8.40059 10.8314 8.66921 11.1 9.00059 11.1V9.9ZM9.03809 13.35C9.36946 13.35 9.63809 13.0814 9.63809 12.75C9.63809 12.4186 9.36946 12.15 9.03809 12.15V13.35ZM9.00059 12.15C8.66921 12.15 8.40059 12.4186 8.40059 12.75C8.40059 13.0814 8.66921 13.35 9.00059 13.35V12.15ZM12.0381 11.1C12.3695 11.1 12.6381 10.8314 12.6381 10.5C12.6381 10.1686 12.3695 9.9 12.0381 9.9V11.1ZM12.0006 9.9C11.6692 9.9 11.4006 10.1686 11.4006 10.5C11.4006 10.8314 11.6692 11.1 12.0006 11.1V9.9ZM12.0381 13.35C12.3695 13.35 12.6381 13.0814 12.6381 12.75C12.6381 12.4186 12.3695 12.15 12.0381 12.15V13.35ZM12.0006 12.15C11.6692 12.15 11.4006 12.4186 11.4006 12.75C11.4006 13.0814 11.6692 13.35 12.0006 13.35V12.15ZM6.6 2.25C6.6 1.91863 6.33137 1.65 6 1.65C5.66863 1.65 5.4 1.91863 5.4 2.25H6.6ZM5.4 4.5C5.4 4.83137 5.66863 5.1 6 5.1C6.33137 5.1 6.6 4.83137 6.6 4.5H5.4ZM12.6 2.25C12.6 1.91863 12.3314 1.65 12 1.65C11.6686 1.65 11.4 1.91863 11.4 2.25H12.6ZM11.4 4.5C11.4 4.83137 11.6686 5.1 12 5.1C12.3314 5.1 12.6 4.83137 12.6 4.5H11.4ZM5.25 3.97502L12.75 3.975L12.75 2.775L5.24999 2.77502L5.25 3.97502ZM15.15 6.37501V12.75H16.35V6.37501H15.15ZM12.75 15.15H5.25V16.35H12.75V15.15ZM2.85 12.75V6.37502H1.65V12.75H2.85ZM5.25 15.15C4.52593 15.15 4.04324 15.1487 3.68404 15.1005C3.3421 15.0545 3.20321 14.976 3.1136 14.8864L2.26508 15.7349C2.61481 16.0847 3.04914 16.2259 3.52414 16.2898C3.98189 16.3513 4.55985 16.35 5.25 16.35V15.15ZM1.65 12.75C1.65 13.4402 1.64873 14.0181 1.71027 14.4759C1.77413 14.9509 1.91534 15.3852 2.26508 15.7349L3.1136 14.8864C3.024 14.7968 2.94554 14.6579 2.89957 14.316C2.85127 13.9568 2.85 13.4741 2.85 12.75H1.65ZM15.15 12.75C15.15 13.4741 15.1487 13.9568 15.1004 14.316C15.0545 14.6579 14.976 14.7968 14.8864 14.8864L15.7349 15.7349C16.0847 15.3852 16.2259 14.9509 16.2897 14.4759C16.3513 14.0181 16.35 13.4402 16.35 12.75H15.15ZM12.75 16.35C13.4401 16.35 14.0181 16.3513 14.4759 16.2898C14.9509 16.2259 15.3852 16.0847 15.7349 15.7349L14.8864 14.8864C14.7968 14.976 14.6579 15.0545 14.316 15.1005C13.9568 15.1487 13.4741 15.15 12.75 15.15V16.35ZM12.75 3.975C13.4741 3.975 13.9568 3.97628 14.316 4.02457C14.6579 4.07054 14.7968 4.149 14.8864 4.23861L15.7349 3.39008C15.3852 3.04035 14.9509 2.89913 14.4759 2.83527C14.0181 2.77373 13.4401 2.775 12.75 2.775L12.75 3.975ZM16.35 6.37501C16.35 5.68486 16.3513 5.10689 16.2897 4.64915C16.2259 4.17414 16.0847 3.73981 15.7349 3.39008L14.8864 4.23861C14.976 4.32821 15.0545 4.4671 15.1004 4.80904C15.1487 5.16824 15.15 5.65094 15.15 6.37501H16.35ZM5.24999 2.77502C4.55985 2.77502 3.98188 2.77375 3.52414 2.83529C3.04914 2.89915 2.61481 3.04037 2.26507 3.3901L3.1136 4.23862C3.20321 4.14902 3.3421 4.07056 3.68404 4.02459C4.04324 3.97629 4.52593 3.97502 5.25 3.97502L5.24999 2.77502ZM2.85 6.37502C2.85 5.65095 2.85127 5.16826 2.89957 4.80906C2.94554 4.46712 3.024 4.32823 3.1136 4.23862L2.26507 3.3901C1.91534 3.73983 1.77413 4.17416 1.71027 4.64916C1.64873 5.10691 1.65 5.68487 1.65 6.37502H2.85ZM2.25 8.1H15.75V6.9H2.25V8.1ZM6.03809 9.9H6.00059V11.1H6.03809V9.9ZM6.03809 12.15H6.00059V13.35H6.03809V12.15ZM9.03809 9.9H9.00059V11.1H9.03809V9.9ZM9.03809 12.15H9.00059V13.35H9.03809V12.15ZM12.0381 9.9H12.0006V11.1H12.0381V9.9ZM12.0381 12.15H12.0006V13.35H12.0381V12.15ZM5.4 2.25V4.5H6.6V2.25H5.4ZM11.4 2.25V4.5H12.6V2.25H11.4Z"
                                    fill="#111827" />
                            </svg>
                        </div>
                        <input type="text"
                            class="block w-full max-w-xs pr-4 pl-10 py-2 text-sm font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none leading-relaxed"
                            placeholder="Monday , Jan 20">
                    </div>
                </div>
    
                <div class="flex items-center gap-4 mb-3.5">
                    <div class="relative mb-5">
                        <label class="flex  items-center mb-1 text-gray-600 text-xs font-medium">Time Start
                        </label>
                        <div class="relative  text-gray-500 focus-within:text-gray-900 ">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                    fill="none">
                                    <path
                                        d="M9 6.74999V9.74999L11.25 12M2.25 3.84099L3.83036 2.25M15.7485 3.84493L14.1682 2.25394M15 9.74999C15 13.0637 12.3137 15.75 9 15.75C5.68629 15.75 3 13.0637 3 9.74999C3 6.43628 5.68629 3.74999 9 3.74999C12.3137 3.74999 15 6.43628 15 9.74999Z"
                                        stroke="#111827" stroke-width="1.2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <input type="text"
                                class="block w-full max-w-xs pr-4 pl-10 py-2 text-sm font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none leading-relaxed"
                                placeholder="03:00 PM">
                        </div>
                    </div>
    
                    <div class="relative mb-5">
                        <label class="flex  items-center mb-1 text-gray-600 text-xs font-medium">Time End
                        </label>
                        <div class="relative  text-gray-500 focus-within:text-gray-900 ">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                    fill="none">
                                    <path
                                        d="M9 6.74999V9.74999L11.25 12M2.25 3.84099L3.83036 2.25M15.7485 3.84493L14.1682 2.25394M15 9.74999C15 13.0637 12.3137 15.75 9 15.75C5.68629 15.75 3 13.0637 3 9.74999C3 6.43628 5.68629 3.74999 9 3.74999C12.3137 3.74999 15 6.43628 15 9.74999Z"
                                        stroke="#111827" stroke-width="1.2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <input type="text"
                                class="block w-full max-w-xs pr-4 pl-10 py-2 text-sm font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none leading-relaxed"
                                placeholder="06:00 PM">
                        </div>
                    </div>
                </div> --}}
    
                <div class="flex items-center justify-between py-2.5 
                px-3.5 rounded-lg border border-gray-200">
                    <div class="block">
                        <p class="text-sm font-semibold text-gray-900 mb-1">Invite Team Members</p>
                        <p class="text-xs font-normal text-gray-500">Invite your teammates to this event</p>
                    </div>
                    <button
                        class="rounded-md p-2.5 bg-gray-100 text-gray-800 transition-all duration-300 hover:text-black hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                            fill="none">
                            <path d="M8 4V12M12 8H4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-button @click="showConfirmInvoice = false" type="secondary">Cancelar</x-button>
            <x-button>Confirmar</x-button>
        </x-slot>
    </x-modal>

</div>
