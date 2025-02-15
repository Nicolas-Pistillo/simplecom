@extends('layouts.dashboards.superadmin')

@section('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css');
    </style>
@endsection

@section('content')
    <!-- Main stats -->
    <section class="mb-16 mx-auto grid grid-cols-1 gap-px bg-gray-900/5 sm:grid-cols-2 lg:grid-cols-4">

        <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
            <dt class="text-sm font-medium leading-6 text-gray-500">Revenue</dt>
            <dd class="text-xs font-medium text-gray-700">+4.75%</dd>
            <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">$405,091.00</dd>
        </div>

        <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
            <dt class="text-sm font-medium leading-6 text-gray-500">Overdue invoices</dt>
            <dd class="text-xs font-medium text-rose-600">+54.02%</dd>
            <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">$12,787.00</dd>
        </div>

        <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
            <dt class="text-sm font-medium leading-6 text-gray-500">Outstanding invoices</dt>
            <dd class="text-xs font-medium text-gray-700">-1.39%</dd>
            <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">$245,988.00</dd>
        </div>

        <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
            <dt class="text-sm font-medium leading-6 text-gray-500">Expenses</dt>
            <dd class="text-xs font-medium text-rose-600">+10.18%</dd>
            <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">$30,156.00</dd>
        </div>

    </section>

    <!-- Statistic widget cards -->
    <div class="flex items-center justify-center mb-16">
        <div class="w-full max-w-3xl">
            <div class="md:flex">

                <div class="w-full md:w-1/3 px-3">
                    <div class="rounded-lg mb-4">
                        <div class="rounded-lg bg-white transition-shadow duration-300 shadow-md hover:shadow-xl relative overflow-hidden">
                            <div class="px-3 pt-8 pb-10 text-center relative z-10">
                                <h4 class="text-sm text-gray-700 leading-tight">Users</h4>
                                <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">3,682</h3>
                                <p class="text-xs text-green-500 leading-tight">▲ 57.1%</p>
                            </div>
                            <div class="absolute bottom-0 inset-x-0">
                                <canvas id="chart1" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <div class="rounded-lg shadow-sm mb-4">
                        <div class="rounded-lg bg-white transition-shadow duration-300 shadow-md hover:shadow-xl relative overflow-hidden">
                            <div class="px-3 pt-8 pb-10 text-center relative z-10">
                                <h4 class="text-sm text-gray-700 leading-tight">Subscribers</h4>
                                <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">11,427</h3>
                                <p class="text-xs text-red-500 leading-tight">▼ 42.8%</p>
                            </div>
                            <div class="absolute bottom-0 inset-x-0">
                                <canvas id="chart2" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <div class="rounded-lg shadow-sm mb-4">
                        <div class="rounded-lg bg-white transition-shadow duration-300 shadow-md hover:shadow-xl relative overflow-hidden">
                            <div class="px-3 pt-8 pb-10 text-center relative z-10">
                                <h4 class="text-sm text-gray-700 leading-tight">Comments</h4>
                                <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">8,028</h3>
                                <p class="text-xs text-green-500 leading-tight">▲ 8.2%</p>
                            </div>
                            <div class="absolute bottom-0 inset-x-0">
                                <canvas id="chart3" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const chartOptions = {
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            tooltips: {
                enabled: false,
            },
            elements: {
                point: {
                    radius: 0
                },
            },
            scales: {
                xAxes: [{
                    gridLines: false,
                    scaleLabel: false,
                    ticks: {
                        display: false
                    }
                }],
                yAxes: [{
                    gridLines: false,
                    scaleLabel: false,
                    ticks: {
                        display: false,
                        suggestedMin: 0,
                        suggestedMax: 10
                    }
                }]
            }
        };
        //
        var ctx = document.getElementById('chart1').getContext('2d');
        var chart = new Chart(ctx, {
            type: "line",
            data: {
                labels: [1, 2, 1, 3, 5, 4, 7],
                datasets: [{
                    backgroundColor: "rgba(101, 116, 205, 0.1)",
                    borderColor: "rgba(101, 116, 205, 0.8)",
                    borderWidth: 2,
                    data: [116, 95, 24, 72, 65, 67, 143],
                }, ],
            },
            options: chartOptions
        });
        //
        var ctx = document.getElementById('chart2').getContext('2d');
        var chart = new Chart(ctx, {
            type: "line",
            data: {
                labels: [2, 3, 2, 9, 7, 7, 4],
                datasets: [{
                    backgroundColor: "rgba(246, 109, 155, 0.1)",
                    borderColor: "rgba(246, 109, 155, 0.8)",
                    borderWidth: 2,
                    data: [2, 3, 2, 9, 7, 7, 4],
                }, ],
            },
            options: chartOptions
        });
        //
        var ctx = document.getElementById('chart3').getContext('2d');
        var chart = new Chart(ctx, {
            type: "line",
            data: {
                labels: [2, 5, 1, 3, 2, 6, 7],
                datasets: [{
                    backgroundColor: "rgba(246, 153, 63, 0.1)",
                    borderColor: "rgba(246, 153, 63, 0.8)",
                    borderWidth: 2,
                    data: [2, 5, 1, 3, 2, 6, 7],
                }, ],
            },
            options: chartOptions
        });
    </script>

    <!-- Horizontal line chart -->
    <div class="flex items-center justify-center mb-16">
        <div class="rounded-lg shadow-lg overflow-hidden w-full md:flex" style="max-width:900px" x-data="{ stockTicker: stockTicker() }"
            x-init="stockTicker.renderChart()">
            <div class="flex w-full md:w-1/2 px-5 p-4 bg-blue-500 text-white items-center">
                <canvas id="chart" class="w-full"></canvas>
            </div>
            <div class="flex w-full md:w-1/2 p-8 bg-white text-gray-600 items-center">
                <div class="w-full">
                    <h3 class="text-lg font-semibold leading-tight text-gray-800" x-text="stockTicker.stockFullName"></h3>
                    <h6 class="text-sm leading-tight mb-2"><span
                            x-text="stockTicker.stockShortName"></span>&nbsp;&nbsp;-&nbsp;&nbsp;Aug 2nd 4:00pm AEST</h6>
                    <div class="flex w-full items-end mb-6">
                        <span class="block leading-none text-3xl text-gray-800"
                            x-text="stockTicker.price.current.toFixed(3)">0</span>
                        <span class="block leading-5 text-sm ml-4 text-green-500"
                            x-text="`${stockTicker.price.high-stockTicker.price.low<0?'▼':'▲'} ${(stockTicker.price.high-stockTicker.price.low).toFixed(3)} (${(((stockTicker.price.high/stockTicker.price.low)*100)-100).toFixed(3)}%)`"></span>
                    </div>
                    <div class="flex w-full text-xs">
                        <div class="flex w-5/12">
                            <div class="flex-1 pr-3 text-left font-semibold">Open</div>
                            <div class="flex-1 px-3 text-right" x-text="stockTicker.price.open.toFixed(3)">0</div>
                        </div>
                        <div class="flex w-7/12">
                            <div class="flex-1 px-3 text-left font-semibold">Market Cap</div>
                            <div class="flex-1 pl-3 text-right" x-text="stockTicker.price.cap.m_formatter()">0</div>
                        </div>
                    </div>
                    <div class="flex w-full text-xs">
                        <div class="flex w-5/12">
                            <div class="flex-1 pr-3 text-left font-semibold">High</div>
                            <div class="px-3 text-right" x-text="stockTicker.price.high.toFixed(3)">0</div>
                        </div>
                        <div class="flex w-7/12">
                            <div class="flex-1 px-3 text-left font-semibold">P/E ratio</div>
                            <div class="pl-3 text-right" x-text="stockTicker.price.ratio.toFixed(2)">0</div>
                        </div>
                    </div>
                    <div class="flex w-full text-xs">
                        <div class="flex w-5/12">
                            <div class="flex-1 pr-3 text-left font-semibold">Low</div>
                            <div class="px-3 text-right" x-text="stockTicker.price.low.toFixed(3)">0</div>
                        </div>
                        <div class="flex w-7/12">
                            <div class="flex-1 px-3 text-left font-semibold">Dividend yield</div>
                            <div class="pl-3 text-right" x-text="`${stockTicker.price.dividend}%`">0%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        Number.prototype.m_formatter = function() {
            return this > 999999 ? (this / 1000000).toFixed(1) + 'M' : this
        };
        let stockTicker = function() {
            return {
                stockFullName: 'SW Limited.',
                stockShortName: 'ASX:SFW',
                price: {
                    current: 2.320,
                    open: 2.230,
                    low: 2.215,
                    high: 2.325,
                    cap: 93765011,
                    ratio: 20.10,
                    dividend: 1.67
                },
                chartData: {
                    labels: ['10:00', '', '', '', '12:00', '', '', '', '2:00', '', '', '', '4:00'],
                    data: [2.23, 2.215, 2.22, 2.25, 2.245, 2.27, 2.28, 2.29, 2.3, 2.29, 2.325, 2.325, 2.32],
                },
                renderChart: function() {
                    let c = false;

                    Chart.helpers.each(Chart.instances, function(instance) {
                        if (instance.chart.canvas.id == 'chart') {
                            c = instance;
                        }
                    });

                    if (c) {
                        c.destroy();
                    }

                    let ctx = document.getElementById('chart').getContext('2d');

                    let chart = new Chart(ctx, {
                        type: "line",
                        data: {
                            labels: this.chartData.labels,
                            datasets: [{
                                label: '',
                                backgroundColor: "rgba(255, 255, 255, 0.1)",
                                borderColor: "rgba(255, 255, 255, 1)",
                                pointBackgroundColor: "rgba(255, 255, 255, 1)",
                                data: this.chartData.data,
                            }, ],
                        },
                        layout: {
                            padding: {
                                right: 10
                            }
                        },
                        options: {
                            legend: {
                                display: false,
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        fontColor: "rgba(255, 255, 255, 1)",
                                    },
                                    gridLines: {
                                        display: false,
                                    },
                                }],
                                xAxes: [{
                                    ticks: {
                                        fontColor: "rgba(255, 255, 255, 1)",
                                    },
                                    gridLines: {
                                        color: "rgba(255, 255, 255, .2)",
                                        borderDash: [5, 5],
                                        zeroLineColor: "rgba(255, 255, 255, .2)",
                                        zeroLineBorderDash: [5, 5]
                                    },
                                }]
                            }
                        }
                    });
                }
            }
        }
    </script>
@endsection