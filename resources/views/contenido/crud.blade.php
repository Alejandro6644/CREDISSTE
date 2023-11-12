@extends('master')

@section('content')
    <div id="content" class="p-4 p-md-5 pt-5">
		<div class="list-group">
			<a href="{!! asset('users') !!}" class="list-group-item list-group-item-action">
				<h3>
					Usuarios	
				</h3>
			</a>		  
			<a href="{!! asset('roles') !!}" class="list-group-item list-group-item-action list-group-item-primary">
				<h3>					
					Roles
				</h3>
			</a>
			<a href="{!! asset('sugerencias') !!}" class="list-group-item list-group-item-action list-group-item-secondary">
				<h3>					
					Sugerencias
				</h3>
			</a>
			<a href="{!! asset('instituciones') !!}" class="list-group-item list-group-item-action list-group-item-success">
				<h3>					
					Instituciones
				</h3>
			</a>
			<a href="{!! asset('paises') !!}" class="list-group-item list-group-item-action list-group-item-danger">
				<h3>					
					Paises
				</h3>
			</a>
			<a href="{!! asset('pagos') !!}" class="list-group-item list-group-item-action list-group-item-warning">
				<h3>					
					Pagos
				</h3>
			</a>
			<a href="{!! asset('notificaciones') !!}" class="list-group-item list-group-item-action list-group-item-info">
				<h3>					
					Notificaciones
				</h3>
			</a>
			<a href="{!! asset('municipios') !!}" class="list-group-item list-group-item-action list-group-item-light">
				<h3>					
					Municipios
				</h3>
			</a>
			<a href="{!! asset('estados') !!}" class="list-group-item list-group-item-action list-group-item-dark">
				<h3>					
					Estados
				</h3>
			</a>
			<a href="{!! asset('documentos') !!}" class="list-group-item list-group-item-action">
				<h3>					
					Documentos
				</h3>
			</a>	
			<a href="{!! asset('detallePagos') !!}" class="list-group-item list-group-item-action list-group-item-danger">
				<h3>					
					Detalle de pagos
				</h3>
			</a>		  
		  </div>
    </div>
@endsection
