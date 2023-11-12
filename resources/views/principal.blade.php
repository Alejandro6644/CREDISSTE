@extends('masterProyecto')
@section('contentOficial')
<link rel="stylesheet" href="{{ asset('/assets/css/estilos.css') }}">
    <div id="content" style="display: flex;flex-direction: column;padding: 0px 12px;">
        @include('proyecto.partes.cabecera')
        <div class="cuerpoOficial row">
			<div class="col d-flex justify-content-center align-items-center">
				@yield('cuerpo')    
			</div>    
		</div>		
        @include('proyecto.partes.pie')
    </div>
@endsection
