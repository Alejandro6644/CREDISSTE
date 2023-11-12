<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@extends('masterProyecto')
@section('contentOficial')
    <div id="content" style="display: flex;flex-direction: column">
        @include('proyecto.partes.cabecera')
        <div class="cuerpoOficial row">
			<div class="col d-flex justify-content-center align-items-center">
				@yield('cuerpo')    
			</div>    
		</div>		
        @include('proyecto.partes.pie')
    </div>
@endsection
