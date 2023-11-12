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
            <h1>Detalle del role</h1>
        </div>
        <div class="cuerpo ">
            <div class="row fila-color" style="width: 100%;">
                <div class="datos" style="width: 100%!important;">
                    <h2>ID: {!! $role->encrypt_id !!}</h2>
                </div>
                <div class="datos"  style="width: 100%!important;">
                    <h2>Nombre del role: {!! $role->nombre !!}</h2>
                </div>
            </div>
        </div>
        <div class="pie">
            <a href="{!! asset('/roles') !!}" class="link-dark">
                <h3 class="regresar">Regresar CRUD roles</h3>
            </a>
        </div>

    </div>
@endsection
