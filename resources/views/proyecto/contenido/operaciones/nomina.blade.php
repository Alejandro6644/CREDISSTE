@extends('proyecto.partes.options')
@section('cuerpoOnLogin')
    <link rel="stylesheet" href="{{ asset('/assets/css/onLogin/sugerencias/estilos.css') }}">
    <div class="dudas-docs-container p-5 pt-0" style="height: 65vh;">
        {{-- <div class="row d-flex justify-content-between ">
            <button class="col-3 btn btn-primary btn-grafica" data-opcion="1">
                <h4>Sueldo Neto</h4>
            </button>
            <button class="col-3 btn btn-success btn-grafica" data-opcion="2">
                <h4>Sueldo Bruto</h4>
            </button>
            <button class="col-3 btn btn-warning btn-grafica" data-opcion="3">
                <h4>Descuentos sobre el sueldo</h4>
            </button>
        </div>
        <div class="row  d-flex justify-content-between mt-2">
            <button class="col-3 btn btn-info" onclick="redirectToRoute('{{ route('generar_pdf', ['encabezado' => 'N', 'opcion' => 1]) }}')">
                <h4>Descargar resúmen de sueldos Netos</h4>
            </button>
            <button class="col-3 btn btn-info " onclick="redirectToRoute('{{ route('generar_pdf', ['encabezado' => 'B', 'opcion' => 1]) }}')">
                <h4>Descargar resúmen de sueldos Brutos</h4>
            </button>
            <button class="col-3 btn btn-info " onclick="redirectToRoute('{{ route('generar_pdf', ['encabezado' => 'D', 'opcion' => 1]) }}')">
                <h4>Descargar resúmen de descuentos sobre el sueldo</h4>
            </button>
        </div> --}}
        <div class="row d-flex justify-content-between">
            <div class="col-3">
                <div class="btn-group " role="group" aria-label="Button group with nested dropdown" >
                    <button type="button" class="btn btn-secondary btn-grafica" data-opcion="1">
                        <h4 style="font-weight: bold">Sueldo Neto</h4>
                    </button>

                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="{{ route('generar_pdf', ['encabezado' => 'N', 'opcion' => 1]) }}"
                                target="_blank">
                                <h4>Ver resúmen de sueldos Netos</h4>
                            </a>
                            <a class="dropdown-item"
                                href="{{ route('generar_pdf', ['encabezado' => 'N', 'opcion' => 2]) }}">
                                <h4>Descargar resúmen de sueldos Netos</h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="btn-group " role="group" aria-label="Button group with nested dropdown" >
                    <button type="button" class="btn btn-secondary btn-grafica" data-opcion="2">
                        <h4 style="font-weight: bold">Sueldo Bruto</h4>
                    </button>

                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="{{ route('generar_pdf', ['encabezado' => 'B', 'opcion' => 1]) }}"
                                target="_blank">
                                <h4>Ver resúmen de sueldos Brutos</h4>
                            </a>
                            <a class="dropdown-item"
                                href="{{ route('generar_pdf', ['encabezado' => 'B', 'opcion' => 2]) }}">
                                <h4>Descargar resúmen de sueldos Brutos</h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="btn-group " role="group" aria-label="Button group with nested dropdown" >
                    <button type="button" class="btn btn-secondary btn-grafica" data-opcion="3">
                        <h4 style="font-weight: bold">Descuentos</h4>
                    </button>

                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="{{ route('generar_pdf', ['encabezado' => 'D', 'opcion' => 1]) }}"
                                target="_blank">
                                <h4>Ver resúmen de descuentos</h4>
                            </a>
                            <a class="dropdown-item"
                                href="{{ route('generar_pdf', ['encabezado' => 'D', 'opcion' => 2]) }}">
                                <h4>Descargar resúmen de descuentos</h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <div class="content">
            <h2 style="text-align: center" id="encabezado">{!! $encabezado !!}</h2>
            <div class="chart-container">
                <canvas id="grafica"></canvas>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('.btn-grafica').click(function() {
                    var opcion = $(this).data('opcion');

                    $.ajax({
                        url: "{{ route('actualizar.grafica', '') }}/" + opcion,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            actualizarGrafica(response);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });
            });

            // Variable global para almacenar el gráfico actual
            var myChart;

            function actualizarGrafica(response) {
                var labels = response.labels;
                var valores = response.valores;
                var encabezado = response.encabezado;

                var ctx = document.getElementById('grafica').getContext('2d');
                var encabezadoElement = document.getElementById('encabezado');
                encabezadoElement.textContent = encabezado;


                // Destruir el gráfico existente si ya existe
                if (myChart) {
                    myChart.destroy();
                }

                myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: encabezado,
                            data: valores,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }



            var labels = {!! json_encode($labels) !!};
            var valores = {!! json_encode($valores) !!};

            var ctx = document.getElementById('grafica').getContext('2d');
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Sueldos',
                        data: valores,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

    </div>
@endsection
