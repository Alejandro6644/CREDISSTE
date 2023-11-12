@extends('proyecto.partes.options')
@section('cuerpoOnLogin')
    <link rel="stylesheet" href="{{ asset('/assets/css/onLogin/sugerencias/estilos.css') }}">
    <div class="dudas-docs-container p-5 pt-0">
        <span class="titulo-container-dudas-docs centrar-todo mb-2">
            
        </span>

        <div class="row">
        </div>
        <div class="w-100 h-100 mt-4 p-0 contenido-central2" action="{{ route('enviarSugerencias') }}" method="POST">
            <h1>¡RESPUESTA ENVIADA EXITOSAMENTE!</h1>
            <img src="{{ asset('assets/images/exito.png') }}" alt="Ejemplo" style="width: 10rem; height: 9rem">            
        </div>
        
    </div>
@endsection
