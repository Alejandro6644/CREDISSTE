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
            <h1>Detalle del Notificacion</h1>
        </div>
        <div class="cuerpo ">
            <div class="row fila-color" style="width: 100%;">
                <div class="datos" style="width: 100%!important;">
                    <h2>
                        Nombre de la notificacion
                        <strong>
                            {!! $notificacion->nombre !!}
                        </strong>
                    </h2>
                </div>
                <div class="datos" style="width: 100%!important;">
                    <h2>
                        Fecha de la notificacion
                        <strong>
                            {{ $fecha = \Carbon\Carbon::parse($notificacion->fecha)->format('Y-m-d') }}
                        </strong>
                    </h2>
                </div>
                <div class="datos" style="width: 100%!important;">
                    <h2>
                        Contenido de la notificacion:
                        <strong>
                            {!! $notificacion->contenido !!}
                    </h2>
                    </strong>
                </div>
                <div class="datos" style="width: 100%!important;">
                    <h2>
                        Archivo de la notificacion:
                        <strong>
                            <a
                                        href="{{ route('notificaciones.descargar', $notificacion->encrypt_id) }}">{{ $notificacion->nombre_archivo }}</a>
                        </strong>
                    </h2>
                </div>
                <div class="datos" style="width: 100%!important;">
                    <h2>
                        Usuario a la que se envió: 
                        <strong>
                            {!! $notificacion->usuario->primer_nombre !!}
                            {!! $notificacion->usuario->primer_apellido !!}
                        </strong>
                    </h2>
                </div>
            </div>
        </div>
        <div class="pie">
            <a href="{!! asset('/notificaciones') !!}" class="link-dark">
                <h3 class="regresar">Regresar CRUD notificaciones</h3>
            </a>
        </div>

    </div>
@endsection
