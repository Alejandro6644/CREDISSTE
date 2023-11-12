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
            <h1>Detalle del usuario</h1>
        </div>
        <div class="cuerpo ">
            <div class="row fila-color" style="width: 100%;">
                <div class="datos">
                    <h2>ID: {!! $usuario->encrypt_id !!}</h2>
                </div>
                <div class="datos">
                    <h2>Primer Nombre: {!! $usuario->primer_nombre !!}</h2>
                </div>
                <div class="datos">
                    <h2>Segundo Nombre : {!! $usuario->segundo_nombre !!}</h2>
                </div>
                <div class="datos">
                    <h2>Primer Nombre: {!! $usuario->primer_apellido !!}</h2>
                </div>
                <div class="datos">
                    <h2>Segundo Nombre: {!! $usuario->segundo_apellido !!}</h2>
                </div>
                <div class="datos">
                    <h2>Contraseña: {!! $usuario->password !!}</h2>
                </div>
                <div class="datos">
                    <h2>id_trabajador: {!! $usuario->id_trabajador !!}</h2>
                </div>
                <div class="datos">
                    <h2>Pais: {!! $usuario->municipio->estado->pais->nombre !!}</h2>
                </div>
                <div class="datos">
                    <h2>Estado: {!! $usuario->municipio->estado->nombre !!}</h2>
                </div>
                <div class="datos">
                    <h2>Municipio: {!! $usuario->municipio->nombre !!}</h2>
                </div>
                <div class="datos">
                    <h2>Institucion: {!! $usuario->institucion->nombre !!}</h2>
                </div>
                <div class="datos">
                    <h2>Role: {!! $usuario->role->nombre!!}</h2>
                </div>
            </div>

        </div>

        <div class="pie">
            <a href="{!! asset('/users') !!}" class="link-dark">
                <h3  class="regresar">Regresar CRUD Usuarios</h3>
            </a>
        </div>

    </div>
@endsection
