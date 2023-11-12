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
            <a href="{!! 'documentos/create' !!}">
                <p class="h2">Crear documento</p>
            </a>
        </div>
        <div class="table-responsive cuerpo">
            @if (isset($e))
                <div class="alert alert-danger">
                    Error al subir el archivo, revise sus datos:
                    {{ $e->getMessage() }}
                </div>
            @endif
            <table id="xd" class="table table-hover p-3 w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Tipo de documento</th>
                        <th>Archivo</th>
                        <th>Nombre del archivo local</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                @php
                    $counter = 1;
                @endphp
                <tbody id="tabla-body">
                    @foreach ($documentos as $documento)
                        <tr class="content-row">
                            <td>
                                <span class="content-data">
                                    {!! $counter !!}
                                </span>
                            </td>
                            <td>
                                <span class="content-data">
                                    {!! $documento->nombre !!}
                                </span>
                            </td>
                            <td>
                                <span class="content-data">
                                    {!! \Carbon\Carbon::parse($documento->fecha)->format('d-m-Y') !!}
                                </span>
                            </td>
                            <td>
                                <span class="content-data">
                                    {!! $documento->tipo_documento !!}
                                </span>
                            </td>
                            <td>
                                @php
                                    $extension = pathinfo($documento->nombre, PATHINFO_EXTENSION);
                                @endphp
                                @if (in_array($extension, ['png', 'jpg', 'jpeg']))
                                    <span class="content-data">
                                        <img src="../storage/fotografias/{{ $documento->nombre_archivo }}" alt="imagen xd" style="height: 6.5rem; width: 15rem; box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);">
                                    </span>
                                @else
                                    <span class="content-data">
                                        <a href="{{ route('documentos.descargar', $documento->encrypt_id) }}">¡DESCARGA
                                            AQUÍ!</a>
                                    </span>
                                @endif
                            </td>

                            <td>
                                <span class="content-data">
                                    {!! $documento->nombre_archivo !!}
                                </span>
                            </td>
                            <td>
                                <span class="content-data">
                                    {!! $documento->usuario->primer_nombre !!}
                                    {!! $documento->usuario->primer_apellido !!}
                                </span>
                            </td>
                            <td>
                                <div class="flex">
                                    <a href="{!! 'documentos/' . $documento->encrypt_id !!}"
                                        class="badge badge-pill badge-success botones alinear-centro">Detalle</a>
                                    <a href="{!! 'documentos/' . $documento->encrypt_id . '/edit' !!}"
                                        class="badge badge-pill badge-success botones alinear-centro">Editar</a>
                                    {!! Form::open(['method' => 'DELETE', 'url' => '/documentos/' . $documento->encrypt_id]) !!}
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
