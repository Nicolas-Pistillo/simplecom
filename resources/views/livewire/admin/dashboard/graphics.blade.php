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
            <canvas id="bar-chart"></canvas>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('line-chart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'Mar', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Ventas',
                    data: [140, 135, 140, 180, 220, 190, 210, 250],
                    borderColor: '#22C55E',
                    backgroundColor: 'rgba(34, 197, 94, 0.05)',
                    borderWidth: 2,
                    tension: 0.4,
                    pointRadius: 2,
                    fill: true,
                }]
            },
            options: {
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
                            title: function() {
                                return 'Revenue Trends';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
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
                        min: 100,
                        max: 260,
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
    </script>

    <script>
        const ctxBar = document.getElementById('bar-chart');

        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Price',
                    data: [450, 520, 480, 650, 720, 580, 640],
                    backgroundColor: '#86efac', // green-300
                    borderRadius: 6,
                    borderSkipped: false
                }]
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
                        display: false
                    }
                }
            }
        });
    </script>
</div>
