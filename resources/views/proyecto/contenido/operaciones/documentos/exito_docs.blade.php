@extends('proyecto.partes.options')
@section('cuerpoOnLogin')
    <link rel="stylesheet" href="{{ asset('/assets/css/onLogin/sugerencias/estilos.css') }}">
    <div class="dudas-docs-container p-5 pt-0">     
        <div class="w-100 h-100 mt-4 p-0 contenido-central2" action="{{ route('enviarSugerencias') }}" method="POST">
            <h1>
                ¡TUS DOCUMENTOS HAN SIDO ENVIADOS CORRECTAMENTE!
                <br>
                ESPERA LA RESPUESTA DE LA INSTITUCIÓN
                <br>
                ¡TEN UN BUEN DÍA!
            </h1>
            <img src="{{ asset('assets/images/exito.png') }}" alt="Ejemplo" style="width: 10rem; height: 9rem">
        </div>

    </div>
@endsection
