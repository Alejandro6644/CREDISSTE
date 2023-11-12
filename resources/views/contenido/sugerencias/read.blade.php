@extends('master')

@section('content')
    <link rel="stylesheet" href="{{ asset('/assets/css/crud/users/show.css') }}">

    <div class="container-fluid mt-4 principal rounded
     "
        style="margin: 0;
    margin-top: 0 !important;
    background-color: #ceffbf; 
    padding: 0 !important;
    width: 90%;
    ">
        <div class="w-100 cabecera">
            <h1>Detalle de la sugerencia</h1>
        </div>
        <div class="cuerpo ">
            <div class="row fila-color" style="width: 100%;">
                <div class="datos">
                    <h2>Contenido: {!! $sugerencia->contenido !!}</h2>
                </div>
                <div class="datos">
                    
                    <h2>Fecha: {{$fecha = \Carbon\Carbon::parse($sugerencia->fecha)->format('Y-m-d');}}</h2>
                </div>
                <div class="datos">
                    <h2>Nombre usuario: 
                        {!! $sugerencia->usuario->primer_nombre !!} 
                        {!! $sugerencia->usuario->primer_apellido !!}
                    </h2>
                </div>              
            </div>
        </div>
        <div class="pie">
            <a href="{!! asset('/sugerencias') !!}" class="link-dark">
                <h3  class="regresar">Regresar CRUD sugerencias</h3>
            </a>
        </div>

    </div>
@endsection
