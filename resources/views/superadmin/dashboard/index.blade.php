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

    <!-- Contact cards -->
    <ul role="list" class="mb-16 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

        <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
            <div class="flex w-full items-center justify-between space-x-6 p-6">
                <div class="flex-1 truncate">
                    <div class="flex items-center space-x-3">
                        <h3 class="truncate text-sm font-medium text-gray-900">Jane Cooper</h3>
                        <span
                            class="inline-flex flex-shrink-0 items-center rounded-full bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Admin</span>
                    </div>
                    <p class="mt-1 truncate text-sm text-gray-500">Regional Paradigm Technician</p>
                </div>
                <img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300"
                    src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                    alt="">
            </div>
            <div>
                <div class="-mt-px flex divide-x divide-gray-200">
                    <div class="flex w-0 flex-1">
                        <a href="mailto:janecooper@example.com"
                            class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path
                                    d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                                <path
                                    d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                            </svg>
                            Email
                        </a>
                    </div>
                    <div class="-ml-px flex w-0 flex-1">
                        <a href="tel:+1-202-555-0170"
                            class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z"
                                    clip-rule="evenodd" />
                            </svg>
                            Call
                        </a>
                    </div>
                </div>
            </div>
        </li>

        <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
            <div class="flex w-full items-center justify-between space-x-6 p-6">
                <div class="flex-1 truncate">
                    <div class="flex items-center space-x-3">
                        <h3 class="truncate text-sm font-medium text-gray-900">Jane Cooper</h3>
                        <span
                            class="inline-flex flex-shrink-0 items-center rounded-full bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Admin</span>
                    </div>
                    <p class="mt-1 truncate text-sm text-gray-500">Regional Paradigm Technician</p>
                </div>
                <img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300"
                    src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                    alt="">
            </div>
            <div>
                <div class="-mt-px flex divide-x divide-gray-200">
                    <div class="flex w-0 flex-1">
                        <a href="mailto:janecooper@example.com"
                            class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path
                                    d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                                <path
                                    d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                            </svg>
                            Email
                        </a>
                    </div>
                    <div class="-ml-px flex w-0 flex-1">
                        <a href="tel:+1-202-555-0170"
                            class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z"
                                    clip-rule="evenodd" />
                            </svg>
                            Call
                        </a>
                    </div>
                </div>
            </div>
        </li>

        <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
            <div class="flex w-full items-center justify-between space-x-6 p-6">
                <div class="flex-1 truncate">
                    <div class="flex items-center space-x-3">
                        <h3 class="truncate text-sm font-medium text-gray-900">Jane Cooper</h3>
                        <span
                            class="inline-flex flex-shrink-0 items-center rounded-full bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Admin</span>
                    </div>
                    <p class="mt-1 truncate text-sm text-gray-500">Regional Paradigm Technician</p>
                </div>
                <img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300"
                    src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                    alt="">
            </div>
            <div>
                <div class="-mt-px flex divide-x divide-gray-200">
                    <div class="flex w-0 flex-1">
                        <a href="mailto:janecooper@example.com"
                            class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path
                                    d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                                <path
                                    d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                            </svg>
                            Email
                        </a>
                    </div>
                    <div class="-ml-px flex w-0 flex-1">
                        <a href="tel:+1-202-555-0170"
                            class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z"
                                    clip-rule="evenodd" />
                            </svg>
                            Call
                        </a>
                    </div>
                </div>
            </div>
        </li>
    </ul>

    <!-- Info cards -->
    <ul role="list" class="mb-16 grid grid-cols-1 gap-x-6 gap-y-8 lg:grid-cols-3 xl:gap-x-8">

        <li x-data="{ open: false }" class="overflow-hidden rounded-xl border border-gray-200">
            <div class="flex items-center gap-x-4 border-b border-gray-900/5 bg-gray-50 p-6">
                <img src="https://tailwindui.com/img/logos/48x48/tuple.svg" alt="Tuple"
                    class="h-12 w-12 flex-none rounded-lg bg-white object-cover ring-1 ring-gray-900/10">
                <div class="text-sm font-medium leading-6 text-gray-900">Tuple</div>
                <div class="relative ml-auto">
                    <button @click="open = !open" @click.away="open = false" type="button"
                        class="-m-2.5 block p-2.5 text-gray-400 hover:text-gray-500" id="options-menu-0-button"
                        aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Open options</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path
                                d="M3 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM8.5 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM15.5 8.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 z-10 mt-0.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="options-menu-0-button"
                        tabindex="-1">
                        <!-- Active: "bg-gray-50", Not Active: "" -->
                        <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem"
                            tabindex="-1" id="options-menu-0-item-0">View<span class="sr-only">, Tuple</span></a>
                        <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem"
                            tabindex="-1" id="options-menu-0-item-1">Edit<span class="sr-only">, Tuple</span></a>
                    </div>
                </div>
            </div>
            <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm leading-6">
                <div class="flex justify-between gap-x-4 py-3">
                    <dt class="text-gray-500">Last invoice</dt>
                    <dd class="text-gray-700"><time datetime="2022-12-13">December 13, 2022</time></dd>
                </div>
                <div class="flex justify-between gap-x-4 py-3">
                    <dt class="text-gray-500">Amount</dt>
                    <dd class="flex items-start gap-x-2">
                        <div class="font-medium text-gray-900">$2,000.00</div>
                        <div
                            class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset text-red-700 bg-red-50 ring-red-600/10">
                            Overdue</div>
                    </dd>
                </div>
            </dl>
        </li>

        <li x-data="{ open: false }" class="overflow-hidden rounded-xl border border-gray-200">
            <div class="flex items-center gap-x-4 border-b border-gray-900/5 bg-gray-50 p-6">
                <img src="https://tailwindui.com/img/logos/48x48/savvycal.svg" alt="SavvyCal"
                    class="h-12 w-12 flex-none rounded-lg bg-white object-cover ring-1 ring-gray-900/10">
                <div class="text-sm font-medium leading-6 text-gray-900">SavvyCal</div>
                <div class="relative ml-auto">
                    <button @click="open = !open" @click.away="open = false" type="button"
                        class="-m-2.5 block p-2.5 text-gray-400 hover:text-gray-500" id="options-menu-1-button"
                        aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Open options</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path
                                d="M3 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM8.5 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM15.5 8.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                        </svg>
                    </button>

                    <div x-show=open x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 z-10 mt-0.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="options-menu-1-button"
                        tabindex="-1">
                        <!-- Active: "bg-gray-50", Not Active: "" -->
                        <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem"
                            tabindex="-1" id="options-menu-1-item-0">View<span class="sr-only">, SavvyCal</span></a>
                        <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem"
                            tabindex="-1" id="options-menu-1-item-1">Edit<span class="sr-only">, SavvyCal</span></a>
                    </div>
                </div>
            </div>
            <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm leading-6">
                <div class="flex justify-between gap-x-4 py-3">
                    <dt class="text-gray-500">Last invoice</dt>
                    <dd class="text-gray-700"><time datetime="2023-01-22">January 22, 2023</time></dd>
                </div>
                <div class="flex justify-between gap-x-4 py-3">
                    <dt class="text-gray-500">Amount</dt>
                    <dd class="flex items-start gap-x-2">
                        <div class="font-medium text-gray-900">$14,000.00</div>
                        <div
                            class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset text-green-700 bg-green-50 ring-green-600/20">
                            Paid</div>
                    </dd>
                </div>
            </dl>
        </li>

        <li x-data="{ open: false }" class="overflow-hidden rounded-xl border border-gray-200">
            <div class="flex items-center gap-x-4 border-b border-gray-900/5 bg-gray-50 p-6">
                <img src="https://tailwindui.com/img/logos/48x48/reform.svg" alt="Reform"
                    class="h-12 w-12 flex-none rounded-lg bg-white object-cover ring-1 ring-gray-900/10">
                <div class="text-sm font-medium leading-6 text-gray-900">Reform</div>
                <div class="relative ml-auto">
                    <button @click="open = !open" @click.away="open = false" type="button"
                        class="-m-2.5 block p-2.5 text-gray-400 hover:text-gray-500" id="options-menu-2-button"
                        aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Open options</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path
                                d="M3 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM8.5 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM15.5 8.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 z-10 mt-0.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="options-menu-2-button"
                        tabindex="-1">
                        <!-- Active: "bg-gray-50", Not Active: "" -->
                        <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem"
                            tabindex="-1" id="options-menu-2-item-0">View<span class="sr-only">, Reform</span></a>
                        <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem"
                            tabindex="-1" id="options-menu-2-item-1">Edit<span class="sr-only">, Reform</span></a>
                    </div>
                </div>
            </div>
            <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm leading-6">
                <div class="flex justify-between gap-x-4 py-3">
                    <dt class="text-gray-500">Last invoice</dt>
                    <dd class="text-gray-700"><time datetime="2023-01-23">January 23, 2023</time></dd>
                </div>
                <div class="flex justify-between gap-x-4 py-3">
                    <dt class="text-gray-500">Amount</dt>
                    <dd class="flex items-start gap-x-2">
                        <div class="font-medium text-gray-900">$7,600.00</div>
                        <div
                            class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset text-green-700 bg-green-50 ring-green-600/20">
                            Paid</div>
                    </dd>
                </div>
            </dl>
        </li>
    </ul>
@endsection
