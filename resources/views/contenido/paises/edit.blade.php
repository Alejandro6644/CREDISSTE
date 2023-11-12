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
                <h2>Editar Pais</h2>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <a href="{!! asset('/paises') !!}" class="link-dark">
                    <h3 class="regresar">Regresar CRUD paiss</h3>
                </a>
            </div>
        </div>
        <div class="cuerpo">
            {!! Form::open(['method' => 'PATCH', 'url' => '/paises/' . $pais->encrypt_id]) !!}

            <section>
                {!! Form::label('nombre', 'Nombre del pais:') !!}
                {!! Form::text('nombre', $pais->nombre, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa nombre del pais',
                    'required',
                ]) !!}
            </section>
            <section>
                {!! Form::label('clave', 'Clave del pais:') !!}
                {!! Form::text('clave', $pais->clave, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa la clave del pais',
                    'required',
                ]) !!}
            </section>
            <section>
                {!! Form::label('status', 'Estatus:') !!}
                {!! Form::select('status', ['1' => 'Activo', '0' => 'Baja'], $pais->status, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Seleccionar ...',
                    'required',
                ]) !!}
            </section>
        </div>

        <div class="pie">
            {!! Form::submit('Guardar pais', ['class' => 'btn btn-success']) !!}
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
