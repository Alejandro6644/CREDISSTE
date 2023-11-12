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
            <h1>Detalle del estado</h1>
        </div>
        <div class="cuerpo ">
            <div class="row fila-color" style="width: 100%;">
                <div class="datos" style="width: 100%!important;">
                    <h2>ID: {!! $estado->encrypt_id !!}</h2>
                </div>
                <div class="datos" style="width: 100%!important;">
                    <h2>
                        Nombre del estado:
                        <strong>
                            {!! $estado->nombre !!}
                        </strong>
                    </h2>
                </div>
                <div class="datos" style="width: 100%!important;">
                    <h2>
                        Pais del estado:
                        <strong>
                            {!! $estado->pais->nombre !!}
                        </strong>
                    </h2>
                </div>

            </div>
        </div>
        <div class="pie">
            <a href="{!! asset('/estados') !!}" class="link-dark">
                <h3 class="regresar">Regresar CRUD estadoes</h3>
            </a>
        </div>

    </div>
@endsection
