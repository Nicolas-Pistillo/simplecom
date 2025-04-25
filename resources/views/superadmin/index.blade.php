@extends('layouts.dashboards.superadmin')

@section('head')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css');
    </style> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('content')
    {{-- <!-- Main stats -->
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
    </script> --}}

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-y-6 lg:gap-x-6 mb-6">
        <!-- Chart 1 -->
        <div
            class="w-full rounded-lg border shadow-sm overflow-hidden bg-white border-stone-200 shadow-stone-950/5 h-full flex flex-col justify-between col-span-2">
            <div class="h-max rounded w-full justify-between flex items-start gap-4 p-4 m-0">
                <div>
                    <small class="font-sans antialiased text-sm text-stone-600 font-semibold block mb-2">Current
                        Price</small>
                    <h2
                        class="font-sans antialiased font-bold text-lg md:text-xl lg:text-2xl text-stone-800 dark:text-white">
                        $156,091.033</h2>
                </div>
                <div class="relative">
                    <div class="dropdown" data-dui-placement="bottom-start">
                        <button data-dui-toggle="dropdown" aria-expanded="false"
                            class="inline-flex items-center justify-center border align-middle select-none font-sans font-medium text-center duration-300 ease-in disabled:opacity-50 disabled:shadow-none disabled:cursor-not-allowed focus:shadow-none text-sm py-2 px-4 shadow-sm hover:shadow-md bg-transparent relative text-stone-700 hover:text-stone-700 border-stone-500 hover:bg-transparent duration-150 hover:border-stone-600 rounded-lg hover:opacity-60 hover:shadow-none">
                            Last 24h
                        </button>
                        <div data-dui-role="menu"
                            class="hidden mt-2 bg-white border border-stone-200 rounded-lg shadow-sm p-1 z-10">
                            <a href="#"
                                class="block px-4 py-2 text-sm text-stone-800 hover:bg-stone-100 rounded-md">Last 6h</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-stone-800 hover:bg-stone-100 rounded-md">Last 12h</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-stone-800 hover:bg-stone-100 rounded-md">Last 24h</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full h-max rounded py-2.5 px-4 pb-4 pt-0">
                <canvas id="chart1" class="h-40 sm:h-56"></canvas>
            </div>
            <div class="w-full rounded flex items-center gap-6 justify-between flex-wrap p-4">
                <div>
                    <small class="font-sans antialiased text-sm text-stone-600 font-semibold block mb-2">Market Cap</small>
                    <h2
                        class="font-sans antialiased font-bold text-lg md:text-xl lg:text-2xl text-stone-800 dark:text-white">
                        $10,932.033</h2>
                </div>
                <div>
                    <small class="font-sans antialiased text-sm text-stone-600 font-semibold block mb-2">24h Volume</small>
                    <h2
                        class="font-sans antialiased font-bold text-lg md:text-xl lg:text-2xl text-stone-800 dark:text-white">
                        $22,122,267</h2>
                </div>
            </div>
        </div>
        <!-- Chart 2 -->
        <div
            class="w-full rounded-lg border shadow-sm overflow-hidden bg-white border-stone-200 shadow-stone-950/5 h-full flex flex-col justify-between col-span-2">
            <div class="h-max rounded w-full justify-between flex items-start gap-4 p-4 m-0">
                <div>
                    <small class="font-sans antialiased text-sm text-stone-600 font-semibold block mb-2">Total
                        Staked</small>
                    <h2
                        class="font-sans antialiased font-bold text-lg md:text-xl lg:text-2xl text-stone-800 dark:text-white">
                        $156,091 SOL</h2>
                </div>
                <div class="relative">
                    <div class="dropdown" data-dui-placement="bottom-start">
                        <button data-dui-toggle="dropdown" aria-expanded="false"
                            class="inline-flex items-center justify-center border align-middle select-none font-sans font-medium text-center duration-300 ease-in disabled:opacity-50 disabled:shadow-none disabled:cursor-not-allowed focus:shadow-none text-sm py-2 px-4 shadow-sm hover:shadow-md bg-transparent relative text-stone-700 hover:text-stone-700 border-stone-500 hover:bg-transparent duration-150 hover:border-stone-600 rounded-lg hover:opacity-60 hover:shadow-none">
                            Last 24h
                        </button>
                        <div data-dui-role="menu"
                            class="hidden mt-2 bg-white border border-stone-200 rounded-lg shadow-sm p-1 z-10">
                            <a href="#"
                                class="block px-4 py-2 text-sm text-stone-800 hover:bg-stone-100 rounded-md">Last 6h</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-stone-800 hover:bg-stone-100 rounded-md">Last 12h</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-stone-800 hover:bg-stone-100 rounded-md">Last 24h</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full h-max rounded py-2.5 px-4 pb-4 pt-0">
                <canvas id="chart2" class="h-40 sm:h-56"></canvas>
            </div>
            <div class="w-full rounded flex items-center gap-6 justify-between flex-wrap p-4">
                <div>
                    <small class="font-sans antialiased text-sm text-stone-600 font-semibold block mb-2">Users
                        Staking</small>
                    <h2
                        class="font-sans antialiased font-bold text-lg md:text-xl lg:text-2xl text-stone-800 dark:text-white">
                        125,850</h2>
                </div>
                <div>
                    <small class="font-sans antialiased text-sm text-stone-600 font-semibold block mb-2">Average APR</small>
                    <h2
                        class="font-sans antialiased font-bold text-lg md:text-xl lg:text-2xl text-stone-800 dark:text-white">
                        8.35%</h2>
                </div>
            </div>
        </div>

        <div class="col-span-full flex flex-col sm:flex-row gap-6">
            <div class="w-full rounded-lg border shadow-sm overflow-hidden bg-white border-stone-200 shadow-stone-950/5">
                <div class="h-max rounded w-full m-0 p-4">
                    <div class="p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-7 h-7 text-stone-800">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                    </div>
                </div>
                <div class="w-full h-max rounded py-2.5 px-4 pb-4 pt-0">
                    <small class="font-sans antialiased text-sm text-stone-600 font-semibold block mb-2">Trust
                        Transaction</small>
                    <h2
                        class="font-sans antialiased font-bold text-lg md:text-xl lg:text-2xl text-stone-800 dark:text-white">
                        16,545</h2>
                </div>
            </div>
            <div class="w-full rounded-lg border shadow-sm overflow-hidden bg-white border-stone-200 shadow-stone-950/5">
                <div class="h-max rounded w-full m-0 p-4">
                    <div class="p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-7 h-7 text-stone-800">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 12a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                        </svg>
                    </div>
                </div>
                <div class="w-full h-max rounded py-2.5 px-4 pb-4 pt-0">
                    <small class="font-sans antialiased text-sm text-stone-600 font-semibold block mb-2">Metamask
                        Transactions</small>
                    <h2
                        class="font-sans antialiased font-bold text-lg md:text-xl lg:text-2xl text-stone-800 dark:text-white">
                        47,720</h2>
                </div>
            </div>
            <div class="w-full rounded-lg border shadow-sm overflow-hidden bg-white border-stone-200 shadow-stone-950/5">
                <div class="h-max rounded w-full m-0 p-4">
                    <div class="p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-7 h-7 text-stone-800">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                </div>
                <div class="w-full h-max rounded py-2.5 px-4 pb-4 pt-0">
                    <small class="font-sans antialiased text-sm text-stone-600 font-semibold block mb-2">Coinbase
                        Transactions</small>
                    <h2
                        class="font-sans antialiased font-bold text-lg md:text-xl lg:text-2xl text-stone-800 dark:text-white">
                        47,720</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full rounded-lg border shadow-sm overflow-hidden bg-white border-stone-200 shadow-stone-950/5">
        <div class="h-max w-full m-0 items-start rounded-none flex flex-wrap gap-4 justify-between p-4">
            <div>
                <p class="font-sans antialiased text-base md:text-lg text-stone-800 dark:text-white font-semibold mb-1">
                    Cryptocurrency Market Overview</p>
                <small class="font-sans antialiased text-sm text-stone-600 block">Compare different cryptocurrencies, and
                    make
                    informed investment.</small>
            </div>
            <div class="flex items-center w-full shrink-0 gap-3 md:w-max">
                <div class="w-72">
                    <div class="relative w-full">
                        <input placeholder="Search here..." type="text"
                            class="w-full aria-disabled:cursor-not-allowed outline-none focus:outline-none text-stone-800 dark:text-white placeholder:text-stone-600/60 ring-transparent border border-stone-200 transition-all ease-in disabled:opacity-50 disabled:pointer-events-none select-none text-sm py-2 pr-8 pl-2.5 ring shadow-sm bg-white rounded-lg duration-100 hover:border-stone-300 hover:ring-none focus:border-stone-400 focus:ring-none peer" />
                        <span
                            class="pointer-events-none absolute right-2 top-1/2 -translate-y-1/2 text-stone-600/70 peer-hover:text-stone-800 peer-focus:text-stone-800 dark:peer-hover:text-white dark:peer-focus:text-white transition-all duration-300 ease-in overflow-hidden w-5 h-5">
                            <svg width="1.5em" height="1.5em" viewBox="0 0 24 24" stroke-width="1.5" fill="none"
                                xmlns="http://www.w3.org/2000/svg" color="currentColor" class="h-full w-full">
                                <path d="M17 17L21 21" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path
                                    d="M3 11C3 15.4183 6.58172 19 11 19C13.213 19 15.2161 18.1015 16.6644 16.6493C18.1077 15.2022 19 13.2053 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11Z"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="dropdown" data-dui-placement="bottom-start">
                    <button data-dui-toggle="dropdown" aria-expanded="false"
                        class="inline-flex items-center justify-center border align-middle select-none font-sans font-medium text-center duration-300 ease-in disabled:opacity-50 disabled:shadow-none disabled:cursor-not-allowed focus:shadow-none text-sm py-2 px-4 shadow-sm hover:shadow-md bg-transparent relative text-stone-700 hover:text-stone-700 border-stone-500 hover:bg-transparent duration-150 hover:border-stone-600 rounded-lg hover:opacity-60 hover:shadow-none">
                        24h
                    </button>
                    <div data-dui-role="menu"
                        class="hidden mt-2 bg-white border border-stone-200 rounded-lg shadow-sm p-1 z-10">
                        <a href="#"
                            class="block px-4 py-2 text-sm text-stone-800 hover:bg-stone-100 rounded-md">All</a>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-stone-800 hover:bg-stone-100 rounded-md">24h</a>
                        <a href="#" class="block px-4 py-2 text-sm text-stone-800 hover:bg-stone-100 rounded-md">1
                            week</a>
                        <a href="#" class="block px-4 py-2 text-sm text-stone-800 hover:bg-stone-100 rounded-md">1
                            month</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full h-max overflow-x-auto mt-4 p-0 rounded-none" scrollbar-thin>
            <table class="w-full min-w-max table-auto">
                <thead>
                    <tr>
                        <th class="border-b text-start border-stone-200 p-4">
                            <small
                                class="font-sans antialiased text-sm text-stone-800 dark:text-white block font-medium">Digital
                                Asset</small>
                        </th>
                        <th class="border-b text-start border-stone-200 p-4">
                            <small
                                class="font-sans antialiased text-sm text-stone-800 dark:text-white block font-medium">Price</small>
                        </th>
                        <th class="border-b text-start border-stone-200 p-4">
                            <small
                                class="font-sans antialiased text-sm text-stone-800 dark:text-white block font-medium">Change</small>
                        </th>
                        <th class="border-b text-start border-stone-200 p-4">
                            <small
                                class="font-sans antialiased text-sm text-stone-800 dark:text-white block font-medium">Volume</small>
                        </th>
                        <th class="border-b text-start border-stone-200 p-4">
                            <small
                                class="font-sans antialiased text-sm text-stone-800 dark:text-white block font-medium">Market
                                Cap</small>
                        </th>
                        <th class="border-b text-start border-stone-200 p-4">
                            <small
                                class="font-sans antialiased text-sm text-stone-800 dark:text-white block font-medium">Trend</small>
                        </th>
                        <th class="border-b text-start border-stone-200 p-4">
                            <small
                                class="font-sans antialiased text-sm text-stone-800 dark:text-white block font-medium"></small>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="group">
                        <td class="p-4 border-b border-stone-200 group-last:border-0">
                            <div class="flex items-center gap-3">
                                <img src="https://raw.githubusercontent.com/creativetimofficial/public-assets/refs/heads/master/david-ui/img/logo-bitcoin.jpg"
                                    alt="Bitcoin" class="w-11 h-11 rounded-md border border-stone-200 p-2" />
                                <div class="space-y-0.5">
                                    <small
                                        class="font-sans antialiased text-sm text-stone-800 dark:text-white font-semibold block">BTC</small>
                                    <small class="font-sans antialiased text-sm block text-stone-600">Bitcoin</small>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 border-b border-stone-200 group-last:border-0">
                            <small class="font-sans antialiased text-sm block text-stone-600">$46,727.30</small>
                        </td>
                        <td class="p-4 border-b border-stone-200 group-last:border-0">
                            <small class="font-sans antialiased text-sm text-green-500 block font-semibold">+2.92%</small>
                        </td>
                        <td class="p-4 border-b border-stone-200 group-last:border-0">
                            <small class="font-sans antialiased text-sm block text-stone-600">$45.31B</small>
                        </td>
                        <td class="p-4 border-b border-stone-200 group-last:border-0">
                            <small class="font-sans antialiased text-sm block text-stone-600">$915.61B</small>
                        </td>
                        <td class="p-4 border-b border-stone-200 group-last:border-0">
                            <div class="h-10 max-w-40 relative">
                                <svg viewBox="0 0 100 30" preserveAspectRatio="none" class="w-full h-full">
                                    <path d="M0,15 L10,10 L20,20 L30,5 L40,15 L50,10 L60,5 L70,15 L80,10 L90,20 L100,10"
                                        fill="none" stroke="#22c55e" stroke-width="2"
                                        vector-effect="non-scaling-stroke" />
                                    <path
                                        d="M0,15 L10,10 L20,20 L30,5 L40,15 L50,10 L60,5 L70,15 L80,10 L90,20 L100,10 L100,30 L0,30"
                                        fill="rgba(34, 197, 94, 0.1)" stroke="none" />
                                </svg>
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-transparent via-transparent to-white/20 dark:to-stone-900/20">
                                </div>
                            </div>
                        </td>
                        <td class="p-4 border-b border-stone-200 group-last:border-0 text-end">
                            <div class="flex justify-center gap-2">
                                <button
                                    class="inline-grid place-items-center border align-middle select-none font-sans font-medium text-center transition-all duration-300 ease-in disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-sm min-w-[34px] min-h-[34px] rounded-md shadow-sm hover:shadow-md bg-transparent border-stone-500 text-stone-800 hover:bg-stone-800 hover:text-stone-50 hover:border-stone-800">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 24 24" stroke-width="1.5"
                                        fill="none" xmlns="http://www.w3.org/2000/svg" color="currentColor"
                                        class="h-5 w-5">
                                        <path d="M7 18H10.5H14" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M7 14H7.5H8" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M7 10H8.5H10" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M7 2L16.5 2L21 6.5V19" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path
                                            d="M3 20.5V6.5C3 5.67157 3.67157 5 4.5 5H14.2515C14.4106 5 14.5632 5.06321 14.6757 5.17574L17.8243 8.32426C17.9368 8.43679 18 8.5894 18 8.74853V20.5C18 21.3284 17.3284 22 16.5 22H4.5C3.67157 22 3 21.3284 3 20.5Z"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M14 5V8.4C14 8.73137 14.2686 9 14.6 9H18" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                                <button
                                    class="inline-grid place-items-center border align-middle select-none font-sans font-medium text-center transition-all duration-300 ease-in disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-sm min-w-[34px] min-h-[34px] rounded-md shadow-sm hover:shadow-md bg-transparent border-stone-500 text-stone-800 hover:bg-stone-800 hover:text-stone-50 hover:border-stone-800">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 24 24" stroke-width="1.5"
                                        fill="none" xmlns="http://www.w3.org/2000/svg" color="currentColor"
                                        class="h-5 w-5">
                                        <path d="M17 17L21 21" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path
                                            d="M3 11C3 15.4183 6.58172 19 11 19C13.213 19 15.2161 18.1015 16.6644 16.6493C18.1077 15.2022 19 13.2053 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11Z"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="group">
                        <td class="p-4 border-b border-stone-200 group-last:border-0">
                            <div class="flex items-center gap-3">
                                <img src="https://raw.githubusercontent.com/creativetimofficial/public-assets/refs/heads/master/david-ui/img/logo-ethereum.jpg"
                                    alt="Ethereum" class="w-11 h-11 rounded-md border border-stone-200 p-2" />
                                <div class="space-y-0.5">
                                    <small
                                        class="font-sans antialiased text-sm text-stone-800 dark:text-white font-semibold block">ETH</small>
                                    <small class="font-sans antialiased text-sm block text-stone-600">Ethereum</small>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 border-b border-stone-200 group-last:border-0">
                            <small class="font-sans antialiased text-sm block text-stone-600">$2,609.30</small>
                        </td>
                        <td class="p-4 border-b border-stone-200 group-last:border-0">
                            <small class="font-sans antialiased text-sm text-green-500 block font-semibold">+6.80%</small>
                        </td>
                        <td class="p-4 border-b border-stone-200 group-last:border-0">
                            <small class="font-sans antialiased text-sm block text-stone-600">$23.42B</small>
                        </td>
                        <td class="p-4 border-b border-stone-200 group-last:border-0">
                            <small class="font-sans antialiased text-sm block text-stone-600">$313.58B</small>
                        </td>
                        <td class="p-4 border-b border-stone-200 group-last:border-0">
                            <div class="h-10 max-w-40 relative">
                                <canvas id="trendChart1" style="width:100%;height:100%;min-width:0"></canvas>
                                <svg class="absolute inset-0 w-full h-full" viewBox="0 0 100 20"
                                    preserveAspectRatio="none">
                                    <path
                                        d="M0,10 L5,8 L10,12 L15,10 L20,14 L25,12 L30,15 L35,10 L40,12 L45,15 L50,13 L55,15 L60,12 L65,10 L70,14 L75,12 L80,15 L85,13 L90,15 L95,10 L100,12"
                                        stroke="rgba(34, 197, 94, 1)" stroke-width="1.5" fill="none" />
                                    <path
                                        d="M0,10 L5,8 L10,12 L15,10 L20,14 L25,12 L30,15 L35,10 L40,12 L45,15 L50,13 L55,15 L60,12 L65,10 L70,14 L75,12 L80,15 L85,13 L90,15 L95,10 L100,12 L100,20 L0,20 Z"
                                        fill="rgba(34, 197, 94, 0.1)" stroke="none" />
                                </svg>
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-transparent via-transparent to-white/20 dark:to-stone-900/20">
                                </div>
                            </div>
                        </td>
                        <td class="p-4 border-b border-stone-200 group-last:border-0 text-end">
                            <div class="flex justify-center gap-2">
                                <button
                                    class="inline-grid place-items-center border align-middle select-none font-sans font-medium text-center transition-all duration-300 ease-in disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-sm min-w-[34px] min-h-[34px] rounded-md shadow-sm hover:shadow-md bg-transparent border-stone-500 text-stone-800 hover:bg-stone-800 hover:text-stone-50 hover:border-stone-800">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 24 24" stroke-width="1.5"
                                        fill="none" xmlns="http://www.w3.org/2000/svg" color="currentColor"
                                        class="h-5 w-5">
                                        <path d="M7 18H10.5H14" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M7 14H7.5H8" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M7 10H8.5H10" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M7 2L16.5 2L21 6.5V19" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path
                                            d="M3 20.5V6.5C3 5.67157 3.67157 5 4.5 5H14.2515C14.4106 5 14.5632 5.06321 14.6757 5.17574L17.8243 8.32426C17.9368 8.43679 18 8.5894 18 8.74853V20.5C18 21.3284 17.3284 22 16.5 22H4.5C3.67157 22 3 21.3284 3 20.5Z"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M14 5V8.4C14 8.73137 14.2686 9 14.6 9H18" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                                <button
                                    class="inline-grid place-items-center border align-middle select-none font-sans font-medium text-center transition-all duration-300 ease-in disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-sm min-w-[34px] min-h-[34px] rounded-md shadow-sm hover:shadow-md bg-transparent border-stone-500 text-stone-800 hover:bg-stone-800 hover:text-stone-50 hover:border-stone-800">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 24 24" stroke-width="1.5"
                                        fill="none" xmlns="http://www.w3.org/2000/svg" color="currentColor"
                                        class="h-5 w-5">
                                        <path d="M17 17L21 21" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path
                                            d="M3 11C3 15.4183 6.58172 19 11 19C13.213 19 15.2161 18.1015 16.6644 16.6493C18.1077 15.2022 19 13.2053 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11Z"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="group">
                        <td class="p-4 border-b border-stone-200 group-last:border-0">
                            <div class="flex items-center gap-3">
                                <img src="https://raw.githubusercontent.com/creativetimofficial/public-assets/refs/heads/master/david-ui/img/logo-usdt.jpg"
                                    alt="TetherUS" class="w-11 h-11 rounded-md border border-stone-200 p-2" />
                                <div class="space-y-0.5">
                                    <small
                                        class="font-sans antialiased text-sm text-stone-800 dark:text-white font-semibold block">USDT</small>
                                    <small class="font-sans antialiased text-sm block text-stone-600">TetherUS</small>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 border-b border-stone-200 group-last:border-0">
                            <small class="font-sans antialiased text-sm block text-stone-600">$1.00</small>
                        </td>
                        <td class="p-4 border-b border-stone-200 group-last:border-0">
                            <small class="font-sans antialiased text-sm text-red-500 block font-semibold">-0.01%</small>
                        </td>
                        <td class="p-4 border-b border-stone-200 group-last:border-0">
                            <small class="font-sans antialiased text-sm block text-stone-600">$94.37B</small>
                        </td>
                        <td class="p-4 border-b border-stone-200 group-last:border-0">
                            <small class="font-sans antialiased text-sm block text-stone-600">$40,600</small>
                        </td>
                        <td class="p-4 border-b border-stone-200 group-last:border-0">
                            <div class="h-10 max-w-40 relative">
                                <svg viewBox="0 0 100 20" class="w-full h-full">
                                    <path d="M0,10 L10,8 L20,12 L30,7 L40,9 L50,6 L60,4 L70,8 L80,3 L90,5 L100,2"
                                        fill="none" stroke="#ef4444" stroke-width="1.5" />
                                    <path
                                        d="M0,10 L10,8 L20,12 L30,7 L40,9 L50,6 L60,4 L70,8 L80,3 L90,5 L100,2 L100,20 L0,20 Z"
                                        fill="rgba(239, 68, 68, 0.1)" stroke="none" />
                                </svg>
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-transparent via-transparent to-white/20 dark:to-stone-900/20">
                                </div>
                            </div>
                        </td>
                        <td class="p-4 border-b border-stone-200 group-last:border-0 text-end">
                            <div class="flex justify-center gap-2">
                                <button
                                    class="inline-grid place-items-center border align-middle select-none font-sans font-medium text-center transition-all duration-300 ease-in disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-sm min-w-[34px] min-h-[34px] rounded-md shadow-sm hover:shadow-md bg-transparent border-stone-500 text-stone-800 hover:bg-stone-800 hover:text-stone-50 hover:border-stone-800">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 24 24" stroke-width="1.5"
                                        fill="none" xmlns="http://www.w3.org/2000/svg" color="currentColor"
                                        class="h-5 w-5">
                                        <path d="M7 18H10.5H14" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M7 14H7.5H8" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M7 10H8.5H10" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M7 2L16.5 2L21 6.5V19" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path
                                            d="M3 20.5V6.5C3 5.67157 3.67157 5 4.5 5H14.2515C14.4106 5 14.5632 5.06321 14.6757 5.17574L17.8243 8.32426C17.9368 8.43679 18 8.5894 18 8.74853V20.5C18 21.3284 17.3284 22 16.5 22H4.5C3.67157 22 3 21.3284 3 20.5Z"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M14 5V8.4C14 8.73137 14.2686 9 14.6 9H18" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                                <button
                                    class="inline-grid place-items-center border align-middle select-none font-sans font-medium text-center transition-all duration-300 ease-in disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-sm min-w-[34px] min-h-[34px] rounded-md shadow-sm hover:shadow-md bg-transparent border-stone-500 text-stone-800 hover:bg-stone-800 hover:text-stone-50 hover:border-stone-800">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 24 24" stroke-width="1.5"
                                        fill="none" xmlns="http://www.w3.org/2000/svg" color="currentColor"
                                        class="h-5 w-5">
                                        <path d="M17 17L21 21" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path
                                            d="M3 11C3 15.4183 6.58172 19 11 19C13.213 19 15.2161 18.1015 16.6644 16.6493C18.1077 15.2022 19 13.2053 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11Z"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const createChart = (ctx, color) => {
            return new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Dataset',
                        data: [400, 450, 400, 650, 720, 580, 640, 810],
                        borderColor: color,
                        backgroundColor: 'transparent',
                        borderWidth: 2,
                        tension: 0.4,
                        pointRadius: 0,
                    }, ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#57534e' // stone-600
                            },
                            border: {
                                display: false
                            }
                        },
                        y: {
                            grid: {
                                color: '#e7e5e4', // stone-200
                                drawBorder: false
                            },
                            ticks: {
                                display: false
                            },
                            border: {
                                display: false
                            }
                        },
                    },
                },
            });
        };
        const chart1Ctx = document.getElementById('chart1').getContext('2d');
        const chart2Ctx = document.getElementById('chart2').getContext('2d');
        createChart(chart1Ctx, '#44403c'); // stone-700
        createChart(chart2Ctx, '#44403c'); // stone-500
    </script>
@endsection