@extends('master')

@section('content')
    <link rel="stylesheet" href="{{ asset('/assets/css/crud/users/create.css') }}">
    <script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="container-fluid mt-4 principal rounded
     "
        style="margin: 0;
    margin-top: 0 !important;
    background-color: #ceffbf; 
    padding: 0 !important;
    ">
        <div class="cabecera">
            <div class="col-4">

            </div>
            <div class="col-4">
                <h2>Editar Role</h2>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <a href="{!! asset('/roles') !!}" class="link-dark">
                    <h3 class="regresar">Regresar CRUD Roles</h3>
                </a>
            </div>
        </div>
        <div class="cuerpo">
            {!! Form::open(['method' => 'PATCH', 'url' => '/roles/' . $role->encrypt_id]) !!}

            <section>
                {!! Form::label('nombre', 'Nombre del role:') !!}
                {!! Form::text('nombre', $role->nombre, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa nombre del role',
                    'required',
                ]) !!}
            </section>
            <section>
                {!! Form::label('status', 'Estatus:') !!}
                {!! Form::select('status', ['1' => 'Activo', '0' => 'Baja'], $role->status, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Seleccionar ...',
                    'required',
                ]) !!}
            </section>
        </div>

        <div class="pie">
            {!! Form::submit('Guardar role', ['class' => 'btn btn-success']) !!}
            {!! Form::close() !!}
        </div>
        <script>
            // Agrega validación del formulario con jQuery
            $(document).ready(function() {
                $('#formulario').submit(function(event) {
                    var isValid = true;
                    $(this).find('[required]').each(function() {
                        if (!$(this).val()) {
                            isValid = false;
                            $(this).addClass('is-invalid');
                        } else {
                            $(this).removeClass('is-invalid');
                        }
                    });
                    if (!isValid) {
                        event.preventDefault();
                    }
                });
            });
        </script>
    </div>
@endsection
