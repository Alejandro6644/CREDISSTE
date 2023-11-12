@extends('master')

@section('content')
    <link rel="stylesheet" href="{{ asset('/assets/css/crud/users/indexUsers.css') }}">
    <script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <div class="container-fluid mt-4 principal rounded
         "
        style="margin: 0;
        margin-top: 0 !important;
        background-color: #ceffbf; 
        padding: 0 !important;
        ">
        <div class="w-100 cabecera">
            <a href="{!! 'sugerencias/create' !!}">
                <p class="h2">Crear sugerencia</p>
            </a>
        </div>
        <div class="table-responsive cuerpo">
            <table id="xd" class="table table-hover p-3 w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Contenido</th>
                        <th>Fecha</th>
                        <th>Nombre del Usuario</th>
                        <th>Datos</th>
                    </tr>
                </thead>
                @php
                    $counter = 1;
                @endphp
                <tbody id="tabla-body">
                    @foreach ($sugerencias as $sugerencia)
                        <tr class="content-row">
                            <td>
                                <span class="content-data">
                                    {!! $counter !!}
                                </span>
                            </td>
                            <td>
                                <span class="content-data">
                                    {!! $sugerencia->contenido !!}
                                </span>
                            </td>
                            <td>
                                <span class="content-data">
                                    {!! \Carbon\Carbon::parse($sugerencia->fecha)->format('d-m-Y') !!}
                                </span>
                            </td>
                            <td>
                                <span class="content-data">
                                    {!! $sugerencia->usuario->primer_nombre !!}
                                    {!! $sugerencia->usuario->primer_apellido !!}
                                </span>
                            </td>
                            <td>
                                <div class="flex">
                                    <a href="{!! 'sugerencias/' . $sugerencia->encrypt_id !!}"
                                        class="badge badge-pill badge-success botones alinear-centro">Detalle</a>
                                    <a href="{!! 'sugerencias/' . $sugerencia->encrypt_id . '/edit' !!}"
                                        class="badge badge-pill badge-success botones alinear-centro">Editar</a>
                                    {!! Form::open(['method' => 'DELETE', 'url' => '/sugerencias/' . $sugerencia->encrypt_id]) !!}
                                    {!! Form::submit('Eliminar', ['class' => 'btn btn-success botones']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                        @php
                            $counter = $counter + 1;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pie align-self-center ">
            <script>
                $(document).ready(function() {
                    $.noConflict();
                    var table = $('#xd').DataTable({
                        "pageLength": 5 // Aquí se especifica el número de filas por página
                    });
                });
            </script>
        </div>
    </div>
@endsection
