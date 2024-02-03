<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="col-md-12 ">
                        <div class="card card-body">
                            <div class="row">
                                <div><h5 class="card-title text-center text-black">Clientes</h5></div>
                                <div id="idgrafico" class="idgrafico d-flex justify-content-center"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var series = @json($data);
            var options = {
                series: series.amountClient,
                chart: {
                    width: '50%',
                    type: 'pie',
                },
                labels: series.status,
                theme: {
                    monochrome: {
                        enabled: true
                    }
                },
                plotOptions: {
                    pie: {
                        dataLabels: {
                            offset: -5
                        }
                    }
                },
                dataLabels: {
                    formatter(val, opts) {
                        const name = opts.w.globals.labels[opts.seriesIndex]
                        return [name, val.toFixed(1) + '%']
                    }
                },
                legend: {
                    show: false
                }
            };

            var chart = new ApexCharts(document.querySelector("#idgrafico"), options);
            chart.render();
        });
    </script>
</x-app-layout>
