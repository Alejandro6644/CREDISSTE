@extends('master')

@section('content')
    <link rel="stylesheet" href="{{ asset('/assets/css/crud/users/show.css') }}">

    <div class="container-fluid mt-4 principal rounded
     "
        style="margin: 0;
    margin-top: 0 !important;
    background-color: #ceffbf; 
    padding: 0 !important;
    width: 92%;
    ">
        <div class="w-100 cabecera">
            <h1>Detalle del documento</h1>
        </div>
        <div class="cuerpo ">
            <div class="row fila-color" style="width: 100%;">
                <div class="datos" style="width: 100%!important;">
                    <h2>ID: {!! $documento->encrypt_id !!}</h2>
                </div>
                <div class="datos" style="width: 100%!important;">
                    <h2>
                        Nombre del documento:
                        <strong>
                            {!! $documento->nombre !!}
                        </strong>
                    </h2>
                </div>
                <div class="datos" style="width: 100%!important;">
                    <h2>
                        Fecha del documento:
                        <strong>
                            {!!$fecha= \Carbon\Carbon::parse($documento->fecha)->format('d-m-Y') !!}
                        </strong>
                    </h2>
                </div>
                <div class="datos" style="width: 100%!important;">
                    <h2>
                        Tipo de documento:
                        <strong>
                            {!! $documento->tipo_documento!!}
                        </strong>
                    </h2>
                </div>
                <div class="datos" style="width: 100%!important;">
                    <h2>
                        Archivo:
                        <strong>
                            <a
                            href="{{ route('documentos.descargar', $documento->encrypt_id) }}">¡DESCARGA AQUÍ!</a>
                        </strong>
                    </h2>
                </div>
                <div class="datos" style="width: 100%!important;">
                    <h2>
                        Usuario:
                        <strong>
                            {!! $documento->usuario->primer_nombre !!}
                            {!! $documento->usuario->primer_apellido !!}
                        </strong>
                    </h2>
                </div>
            </div>
        </div>
        <div class="pie">
            <a href="{!! asset('/documentos') !!}" class="link-dark">
                <h3 class="regresar">Regresar CRUD documentos</h3>
            </a>
        </div>

    </div>
@endsection
