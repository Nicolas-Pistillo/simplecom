<div class="mt-12">

    <div class="w-full p-4 bg-white rounded-lg shadow-md mb-8">
        <div class="mb-4">
            <div class="flex items-center justify-between gap-x-3">
                <div>
                    <h3 class="text-sm text-stone-500 mb-1 font-semibold">Ventas</h3>
                    <p class="text-sm text-stone-800 font-medium">
                        Evolución de ventas confirmadas
                    </p>
                </div>

                <x-button type="secondary">Descargar</x-button>
            </div>
        </div>
        <div>
            <canvas class="h-64" id="sales-evolution-chart"></canvas>
        </div>
    </div>

    <div class="w-full p-4 bg-white rounded-lg shadow-md mb-8">
        <div class="mb-4">
            <div class="flex items-center justify-between gap-x-3">
                <div>
                    <h3 class="text-sm text-stone-500 mb-1 font-semibold">
                        Registro de Usuarios
                    </h3>
                    <p class="text-sm text-stone-800 font-medium">
                        Comparativa entre usuarios invitados y registrados
                    </p>
                </div>

                <x-button type="secondary">Descargar</x-button>
            </div>
        </div>
        <div>
            <canvas class="h-64" id="user-registration-chart"></canvas>
        </div>
    </div>

    <div class="flex items-center flex-wrap md:flex-nowrap gap-x-4 gap-y-8 mb-8">

        <div class="w-full md:w-1/2 p-4 bg-white rounded-lg shadow-md">
            <div class="mb-4">
                <div class="flex items-center justify-between gap-x-3">
                    <div>
                        <h3 class="text-sm text-stone-500 mb-1 font-semibold">
                            Métodos de Pago
                        </h3>
                        <p class="text-sm text-stone-800 font-medium">
                            Los métodos de pago más elegidos
                        </p>
                    </div>

                    <x-button type="secondary">Descargar</x-button>
                </div>
            </div>
            <div>
                <canvas class="h-64" id="top-payment-methods-chart"></canvas>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-4 bg-white rounded-lg shadow-md">
            <div class="mb-4">
                <div class="flex items-center justify-between gap-x-3">
                    <div>
                        <h3 class="text-sm text-stone-500 mb-1 font-semibold">
                            TOP 5
                        </h3>
                        <p class="text-sm text-stone-800 font-medium">
                            Categorías más vendidas
                        </p>
                    </div>

                    <x-button type="secondary">Descargar</x-button>
                </div>
            </div>
            <div>
                <canvas class="h-64" id="top-categories-chart"></canvas>
            </div>
        </div>
    </div>

    @if ($topProducts->isNotEmpty())
        <div class="w-full p-4 bg-white rounded-lg shadow-md mb-8">
            <div class="mb-4">
                <div class="flex items-center justify-between gap-x-3">
                    <div>
                        <h3 class="text-sm text-stone-500 mb-1 font-semibold">
                            TOP 5
                        </h3>
                        <p class="text-sm text-stone-800 font-medium">
                            Productos más vendidos
                        </p>
                    </div>

                    <x-button type="secondary">Descargar</x-button>
                </div>
            </div>
            <div>
                <ul role="list" class="divide-y divide-gray-100">
                    @foreach ($topProducts as $product)
                        <li wire:key='top-product-{{ $product->id }}' 
                        class="relative flex py-4 justify-between gap-x-6">
                            <div class="flex min-w-0 gap-x-4">
                                <img src="{{ $product->first_image }}"
                                    alt="" class="w-10 h-10 rounded-lg flex-none bg-gray-50" />
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm/6 font-semibold text-gray-900">
                                        {{ $product->name }}
                                    </p>
                                    <p class="mt-1 flex text-xs/5 text-gray-500">
                                        <a href="mailto:leslie.alexander@example.com"
                                        class="relative truncate hover:underline">
                                            Unidades vendidas: {{ $product->total_sold }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="flex shrink-0 items-center gap-x-4">
                                <div class="hidden sm:flex sm:flex-col sm:items-end">
                                    <p class="text-sm/6 text-gray-900">
                                        <x-badge color="blue">
                                            {{ $product->category->name }}
                                        </x-badge>
                                    </p>
                                    <a href="{{ route('admin.orders.show', $product->last_sale->order_id) }}" 
                                    class="mt-1 text-xs/5 text-gray-500 hover:text-blue-500 hover:underline">
                                        Ultima venta
                                        @if ($period === PeriodOption::Today)
                                            {{ getElapsedTime($product->last_sale->created_at) }}
                                        @else
                                            {{ $product->last_sale->created_at->format('d/m/Y H:i') }}
                                        @endif                                        
                                        -
                                        Pedido {{ $product->last_sale->order_id }}
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @script
        <script>
            Livewire.on('update-graphics', () => {
                $wire.call('salesEvolution')
                    .then(data => {
                        const prevChart = Chart.getChart('sales-evolution-chart');

                        if (prevChart != undefined) prevChart.destroy();

                        const chart = document.getElementById('sales-evolution-chart');

                        new Chart(chart, {
                            type: 'line',
                            data: {
                                labels: data.labels,
                                datasets: [{
                                    label: 'Ventas',
                                    data: data.data,
                                    borderColor: '{{ getRawColor(tenant('color')) }}',
                                    backgroundColor: '{{ getRawLightedColor(tenant('color')) }}',
                                    borderWidth: 2.5,
                                    tension: 0.4,
                                    pointRadius: 2,
                                    fill: true,
                                }]
                            },
                            options: {
                                interaction: {
                                    mode: 'index',
                                    intersect: false
                                },
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false
                                    },
                                    tooltip: {
                                        enabled: true,
                                        backgroundColor: 'white',
                                        titleColor: '#1F2937',
                                        bodyColor: '#1F2937',
                                        borderColor: '#E5E7EB',
                                        borderWidth: 1,
                                        padding: 12,
                                        displayColors: false,
                                        callbacks: {
                                            label: function(context) {
                                                let label = context.dataset.label || '';

                                                if (label) label += ': ';

                                                if (context.parsed.y !== null) {
                                                    label += '$' + context.parsed.y.toLocaleString(
                                                        'es-ES', {
                                                            minimumFractionDigits: 2,
                                                            maximumFractionDigits: 2
                                                        });
                                                }
                                                return label;
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        grid: {
                                            display: true
                                        },
                                        ticks: {
                                            color: '#6B7280',
                                            font: {
                                                size: 10
                                            }
                                        },
                                        border: {
                                            display: false
                                        }
                                    },
                                    y: {
                                        grid: {
                                            color: '#F3F4F6',
                                        },
                                        ticks: {
                                            color: '#6B7280',
                                            stepSize: 40,
                                            padding: 10,
                                            font: {
                                                size: 10
                                            }
                                        },
                                        border: {
                                            display: false
                                        }
                                    }
                                }
                            }
                        });
                    });

                $wire.call('userRegistration')
                    .then(data => {
                        const prevChart = Chart.getChart('user-registration-chart');

                        if (prevChart != undefined) prevChart.destroy();

                        const chart = document.getElementById('user-registration-chart');

                        new Chart(chart, {
                            type: 'bar',
                            data: {
                                labels: data.labels,
                                datasets: data.datasets
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                },
                                scales: {
                                    x: {
                                        display: true
                                    }
                                }
                            }
                        });
                    });

                $wire.call('mostUsedPaymentMethods')
                    .then(data => {
                        const prevChart = Chart.getChart('top-payment-methods-chart');

                        if (prevChart != undefined) prevChart.destroy();

                        const chart = document.getElementById('top-payment-methods-chart');

                        new Chart(chart, {
                            type: 'bar',
                            data: {
                                labels: data.labels,
                                datasets: [{
                                    label: 'Pedidos',
                                    data: data.data,
                                    backgroundColor: '{{ getRawColor(tenant('color')) }}', // green-300
                                    borderRadius: 4,
                                    borderSkipped: false
                                }]
                            },
                            options: {
                                indexAxis: 'y',
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                }
                            }
                        });
                    });

                $wire.call('bestSellingCategories')
                    .then(data => {
                        const prevChart = Chart.getChart('top-categories-chart');

                        if (prevChart != undefined) prevChart.destroy();

                        const chart = document.getElementById('top-categories-chart');

                        new Chart(chart, {
                            type: 'pie',
                            data: {
                                labels: data.labels,
                                datasets: [{
                                    label: 'Unidades vendidas',
                                    data: data.data,
                                }]
                            },
                            options: {
                                indexAxis: 'y',
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: 'top'
                                    }
                                },
                                scales: {
                                    x: {
                                        display: false
                                    }
                                }
                            }
                        });
                    });
            });
        </script>
    @endscript
</div>
