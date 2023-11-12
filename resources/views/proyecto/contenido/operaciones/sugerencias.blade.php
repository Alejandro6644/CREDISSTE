@extends('proyecto.partes.options')
@section('cuerpoOnLogin')
    <link rel="stylesheet" href="{{ asset('/assets/css/onLogin/sugerencias/estilos.css') }}">
    <div class="dudas-docs-container p-5 pt-0">
        <span class="titulo-container-dudas-docs centrar-todo mb-2">
            En esta sección podrás dejar comentarios o sugerencias que desees sean integradas dentro del sitio.
        </span>

        <div class="row">
        </div>
        <form class="w-100 h-100 mt-4 p-0 contenido-central" action="{{ route('enviarSugerencias') }}" method="POST">
            @csrf
            <textarea class="form-control informacion-documentos" id="exampleFormControlTextarea1" name="sugerencia" rows="3"
                style="box-shadow: 10px 5px 5px black;" placeholder="Escribe aquí tus sugerencias"required></textarea>
            <div class="pie-boton">
                <button type="submit" class="btn btn-danger">Enviar</button>
            </div>
        </form>

    </div>
@endsection
