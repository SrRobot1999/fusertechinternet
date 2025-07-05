@extends('layouts.app')

@section('content')
<div class="row ">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">Contratos</h5>
                                <h2 class="mb-3 font-18">{{$contratosActivos}}</h2>
                                <p class="mb-0"><span class="col-green">activos</span> </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img">
                                <img src="{{ asset('img/banner/1.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15"> Clientes</h5>
                                <h2 class="mb-3 font-18">{{$clientesActivos}}</h2>
                                <p class="mb-0"><span class="col-green">Activos</span> </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img">
                                <img src="{{ asset('img/banner/2.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">Tickets</h5>
                                <h2 class="mb-3 font-18">{{$ticketsActivos}}</h2>
                                <p class="mb-0"><span class="col-red">Pendientes</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img">
                                <img src="{{ asset('img/banner/3.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">Pagos</h5>
                                <h2 class="mb-3 font-18">S/. {{$montoMesActual}}</h2>
                                <p class="mb-0">Mes actual</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img">
                                <img src="{{ asset('img/banner/4.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card ">
            <div class="card-header">
                <h4>Pagos por mes</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="chartPagos"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-12 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4>Clientes por zonas</h4>
            </div>
            <div class="card-body">
                <div class="summary">
                    <div class="summary-chart active" data-tab-group="summary-tab" id="summary-chart">
                        <div id="chartZonas" class="chartsh"></div>
                    </div>
                    <div data-tab-group="summary-tab" id="summary-text">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4>Servicios por planes</h4>
            </div>
            <div class="card-body">
                <div id="chartPlanes" class="chartsh"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4>Pagos trimestrales</h4>
            </div>
            <div class="card-body">
                <div id="chart2" class="chartsh"></div>
            </div>
        </div>
    </div>
</div>

</section>

@endsection

@push('scripts_template')
<!-- JS Libraies -->
<script src="{{ asset('bundles/apexcharts/apexcharts.min.js') }}"></script>
<!-- Page Specific JS File -->
<!-- <script src="{{ asset('js/page/index.js') }}"></script> -->
<script>
    function pagosPorMes() {
        $.ajax({
            url: "/pagosPorMes",
            method: "GET",
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {
                console.log(respuesta);

                // Mapeo manual de nombre de mes a número
                const mesesMap = {
                    'Enero': '01',
                    'Febrero': '02',
                    'Marzo': '03',
                    'Abril': '04',
                    'Mayo': '05',
                    'Junio': '06',
                    'Julio': '07',
                    'Agosto': '08',
                    'Septiembre': '09',
                    'Octubre': '10',
                    'Noviembre': '11',
                    'Diciembre': '12'
                };

                // Año actual (ajusta si tu backend usa otro)
                const anio = new Date().getFullYear();

                const dates = respuesta.map(item => {
                    const mesNumero = mesesMap[item.mes];
                    const fechaISO = `${anio}-${mesNumero}-01`; // formato YYYY-MM-DD
                    return {
                        x: fechaISO,
                        y: item.total
                    };
                });

                var options = {
                    series: [{
                        name: 'Pagos mensuales',
                        data: dates
                    }],
                    chart: {
                        type: 'area',
                        stacked: false,
                        height: 350,
                        zoom: {
                            type: 'x',
                            enabled: true,
                            autoScaleYaxis: true
                        },
                        toolbar: {
                            autoSelected: 'zoom'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    markers: {
                        size: 0,
                    },
                    title: {
                        text: 'Evolución de Pagos por Mes',
                        align: 'left'
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            inverseColors: false,
                            opacityFrom: 0.5,
                            opacityTo: 0,
                            stops: [0, 90, 100]
                        },
                    },
                    yaxis: {
                        labels: {
                            formatter: function(val) {
                                return "S/ " + val.toFixed(0);
                            },
                        },
                        title: {
                            text: 'Monto'
                        },
                    },
                    xaxis: {
                        type: 'datetime',
                    },
                    tooltip: {
                        shared: false,
                        y: {
                            formatter: function(val) {
                                return "S/ " + val.toFixed(2);
                            }
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#chartPagos"), options);
                chart.render();
            }

        });
    }

    function chartZonas() {
        $.ajax({
            url: "/chartZonas",
            method: "GET",
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {
                const labels = respuesta.map(item => item.zona);
                const values = respuesta.map(item => item.cantidad);


                var options = {
                    series: values,
                    labels: labels,
                    chart: {
                        type: 'donut',
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function(val, opts) {

                            return opts.w.config.series[opts.seriesIndex];
                        },
                        style: {
                            fontSize: '14px',
                            fontWeight: 'bold'
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val;
                            }
                        }
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    name: {
                                        show: true
                                    },
                                    value: {
                                        show: true,
                                        formatter: function(val) {
                                            return val;
                                        }
                                    },
                                    total: {
                                        show: false
                                    }
                                }
                            }
                        }
                    },
                    legend: {
                        position: 'right'
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#chartZonas"), options);
                chart.render();
            }
        });
    }

    function chartPlanes() {
        $.ajax({
            url: "/chartPlanes",
            method: "GET",
            dataType: "json",
            success: function(respuesta) {
                const labels = respuesta.map(item => item.plan);
                const values = respuesta.map(item => item.cantidad);

                var options = {
                    series: values,
                    labels: labels,
                    chart: {
                        type: 'donut',
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function(val, opts) {
                            return opts.w.config.series[opts.seriesIndex];
                        },
                        style: {
                            fontSize: '14px',
                            fontWeight: 'bold'
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val;
                            }
                        }
                    },
                    legend: {
                        position: 'right'
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#chartPlanes"), options);
                chart.render();
            }
        });
    }

    $.ajax({
        url: "/chartPagosTrimestrales",
        method: "GET",
        dataType: "json",
        success: function(respuesta) {
            console.log('Respuesta completa:', respuesta);

            const labels = respuesta.map(item => item.mes);
            const values = respuesta.map(item => {
                const valor = parseFloat(item.total);
                return isNaN(valor) ? 0 : valor;
            });

            console.log('Labels:', labels);
            console.log('Values:', values);

            var options = {
                series: [{
                    name: 'Total',
                    data: values
                }],
                chart: {
                    type: 'bar',
                    height: 320
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '50%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return 'S/ ' + val.toFixed(2);
                    },
                    style: {
                        fontSize: '12px'
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return 'S/ ' + val.toFixed(2);
                        }
                    }
                },
                xaxis: {
                    categories: labels
                },
                yaxis: {
                    labels: {
                        formatter: function(val) {
                            return 'S/ ' + val.toFixed(2);
                        }
                    }
                },
                legend: {
                    position: 'top'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 250
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: '70%'
                            }
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#chart2"), options);
            chart.render();
        },
        error: function(xhr, status, error) {
            console.error('Error en AJAX:', error);
            console.error('Status:', status);
            console.error('Response:', xhr.responseText);
        }
    });



    document.addEventListener("DOMContentLoaded", function() {
        chartPlanes();
        chartZonas();
        pagosPorMes();
        chartPagosTrimestrales();
    });
</script>
@endpush