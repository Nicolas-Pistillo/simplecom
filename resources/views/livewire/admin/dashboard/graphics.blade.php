<div class="mt-12">

    <div class="w-full p-4 bg-white rounded-lg shadow-md mb-8">
        <div class="mb-4">
            <h3 class="text-sm text-stone-500 mb-1 font-semibold">Revenue Trends</h3>
            <p class="text-sm text-stone-800 font-medium">
                Evolución de las ultimas ventas
            </p>
        </div>
        <div>
            <canvas class="h-64" id="line-chart"></canvas>
        </div>
    </div>

    <div class="w-full p-4 bg-white rounded-lg shadow-md mb-8">
        <div class="mb-4">
            <h3 class="text-sm text-stone-500 mb-1 font-semibold">Weekly Pricing</h3>
            <p class="text-sm text-stone-800 font-medium">
                Visual representation of pricing data throughout the week.
            </p>
        </div>
        <div>
            <canvas class="h-64" id="bar-chart"></canvas>
        </div>
    </div>

    <div class="flex items-center flex-wrap md:flex-nowrap gap-x-4 gap-y-8 mb-8">

        <div class="w-full md:w-1/2 p-4 bg-white rounded-lg shadow-md">
            <div class="mb-4">
                <h3 class="text-sm text-stone-500 mb-1 font-semibold">Weekly Pricing</h3>
                <p class="text-sm text-stone-800 font-medium">
                    Visual representation of pricing data throughout the week.
                </p>
            </div>
            <div>
                <canvas class="h-64" id="h-bar-chart"></canvas>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-4 bg-white rounded-lg shadow-md">
            <div class="mb-4">
                <h3 class="text-sm text-stone-500 mb-1 font-semibold">Weekly Pricing</h3>
                <p class="text-sm text-stone-800 font-medium">
                    Visual representation of pricing data throughout the week.
                </p>
            </div>
            <div>
                <canvas class="h-64" id="pie-chart"></canvas>
            </div>
        </div>
    </div>

    {{-- Line Chart --}}
    @script
        <script>
            Livewire.on('update-graphics', () => 
            {
                $wire.call('orderEvolution')
                    .then(data => 
                    {
                        const prevChart = Chart.getChart('line-chart');

                        if (prevChart != undefined) prevChart.destroy();

                        const chart = document.getElementById('line-chart');

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
                                            label: function(context) 
                                            {
                                                let label = context.dataset.label || '';

                                                if (label) label += ': ';
                                                
                                                if (context.parsed.y !== null) {
                                                    label += '$' + context.parsed.y.toLocaleString('es-ES', {
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

                $wire.call('getUserRegistration')
                    .then(data => 
                    {
                        const prevChart = Chart.getChart('bar-chart');

                        if (prevChart != undefined) prevChart.destroy();

                        const chart = document.getElementById('bar-chart');

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

                $wire.call('getMostUsedPaymentMethods')
                    .then(data => 
                    {
                        const prevChart = Chart.getChart('h-bar-chart');

                        if (prevChart != undefined) prevChart.destroy();

                        const chart = document.getElementById('h-bar-chart');

                        new Chart(chart, {
                            type: 'bar',
                            data: {
                                labels: ['Mercado Pago', 'Mobbex', 'Nave', 'Transferencia'],
                                datasets: [{
                                    label: 'Pedidos',
                                    data: data,
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

                $wire.call('getBestSellingCategories')
                    .then(data => 
                    {
                        const prevChart = Chart.getChart('pie-chart');

                        if (prevChart != undefined) prevChart.destroy();

                        const chart = document.getElementById('pie-chart');

                        new Chart(chart, {
                            type: 'pie',
                            data: {
                                labels: ['Mercado Pago', 'Mobbex', 'Nave', 'MODO', 'Transferencia'],
                                datasets: [{
                                    label: 'Pedidos',
                                    data: data,
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
