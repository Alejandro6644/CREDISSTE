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
                <h2>Editar documento</h2>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <a href="{!! asset('/documentos') !!}" class="link-dark">
                    <h3 class="regresar">Regresar CRUD documentos</h3>
                </a>
            </div>
        </div>
        <div class="cuerpo">

            {!! Form::open(['method' => 'PATCH', 'url' => '/documentos/' . $documento->encrypt_id, 'enctype' => 'multipart/form-data']) !!}

            <section>
                {!! Form::label('nombre', 'Nombre del documento:') !!}
                {!! Form::text('nombre', $documento->nombre, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa el Nombre de la documento',
                    'required',
                    'id' => 'nombre_documento',

                ]) !!}
            </section>
            <section>
                {!! Form::label('fecha', 'Fecha del documento:') !!}
                {!! Form::date('fecha', $fecha, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa la Fecha del documento',
                    'required',
                ]) !!}
            </section>   
            <section>
                {!! Form::label('tipo_documento', 'Tipo De documento:') !!}
                {!! Form::text('tipo_documento', $documento->tipo_documento, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa el tipo de documento',
                    'required',
                ]) !!}
            </section>   
            <section>
                {!! Form::label('archivo', 'archivo del documento:') !!}
                {!! Form::file('archivo', [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa el archivo del documento',
                    'accept' => '.jpg, /jpeg, .bmp, .png,.doc, .docx, .pdf',
                    'required',
                ]) !!}
                @if ($documento->archivo)
                    <p>Archivo actual: <br> {{ $documento->nombre }}</p>
                    <a
                    href="{{ route('documentos.descargar', $documento->encrypt_id) }}">Descargar <br> aquí</a>
                @endif
            </section>      
            <section>
                {!! Form::label('id_usuario', 'Nombre del usuario: ') !!}
                {!! Form::select(
                    'id_usuario',
                    $usuarios->pluck('primer_nombre', 'encrypt_id')->all(),
                    $documento->usuario->encrypt_id,
                    [
                        'class' => 'form-control border-primary text-primary bg-light select-3rem',
                        'placeholder' => 'Seleccionar ...',
                        'required',
                    ],
                ) !!}
            </section>
            <section>
                {!! Form::label('status', 'Estatus:') !!}
                {!! Form::select('status', ['1' => 'Activo', '0' => 'Baja'], $documento->status, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Seleccionar ...',
                    'required',
                ]) !!}
            </section>
        </div>

        <div class="pie">
            {!! Form::submit('Guardar documento', ['class' => 'btn btn-success']) !!}
            {!! Form::close() !!}
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('input[type="file"]').change(function(e) {
                    var fileName = e.target.files[0].name;
                    $('#nombre_documento').val(fileName);
                });
            });
        </script>
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
