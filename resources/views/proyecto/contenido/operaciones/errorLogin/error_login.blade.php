@extends('proyecto.partes.options')
@section('cuerpoOnLogin')
    <link rel="stylesheet" href="{{ asset('/assets/css/onLogin/sugerencias/estilos.css') }}">
    <div class="dudas-docs-container p-5 pt-0">     
        <div class="w-100 h-100 mt-4 p-0 contenido-central2" action="{{ route('enviarSugerencias') }}" method="POST">
            <h1>
               NO TIENES LOS PERMISOS NECESARIOS PARA ACCEDER A ESTA RUTA
            </h1>
            <img src="{{ asset('assets/images/warning.png') }}" alt="Ejemplo" style="width: 10rem; height: 9rem">
        </div>

    </div>
@endsection
