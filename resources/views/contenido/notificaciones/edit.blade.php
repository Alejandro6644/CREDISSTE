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
                <h2>Editar notificacion</h2>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <a href="{!! asset('/notificaciones') !!}" class="link-dark">
                    <h3 class="regresar">Regresar CRUD notificaciones</h3>
                </a>
            </div>
        </div>
        <div class="cuerpo">
            {!! Form::open(['method' => 'PATCH', 'url' => '/notificaciones/' . $notificacion->encrypt_id, 'enctype' => 'multipart/form-data']) !!}
            <section>
                {!! Form::label('nombre', 'Nombre de la notificacion:') !!}
                {!! Form::text('nombre', $notificacion->nombre, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa el Nombre de la notificacion',
                    'required',
                ]) !!}
            </section>
            <section>
                {!! Form::label('fecha', 'Fecha de la notificacion:') !!}
                {!! Form::date('fecha', $fecha, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa la Fecha de la notificacion',
                    'required',
                ]) !!}
            </section>
            <section>
                {!! Form::label('contenido', 'Contenido de la notificacion:') !!}
                {!! Form::text('contenido', $notificacion->contenido, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa el contenido de la notificacion',
                    'required',
                ]) !!}
            </section>

            <section>
                {!! Form::label('archivo', 'archivo de la notificación:') !!}
                {!! Form::file('archivo', [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa el archivo de la notificación',
                    'accept' => '.jpg, /jpeg, .bmp, .png,.doc, .docx, .pdf',
                    'required',
                ]) !!}
                @if ($notificacion->archivo)
                    <p>Archivo actual: {{ $notificacion->nombre_archivo }}</p>
                    <a
                    href="{{ route('notificaciones.descargar', $notificacion->encrypt_id) }}">{{ $notificacion->nombre_archivo }}</a>
                @endif
            </section>

            <section>
                {!! Form::label('id_usuario', 'Nombre del usuario: ') !!}
                {!! Form::select(
                    'id_usuario',
                    $usuarios->pluck('primer_nombre', 'encrypt_id')->all(),
                    $notificacion->usuario->encrypt_id,
                    [
                        'class' => 'form-control border-primary text-primary bg-light select-3rem',
                        'placeholder' => 'Seleccionar ...',
                        'required',
                    ],
                ) !!}
            </section>

            <section>
                {!! Form::label('status', 'Estatus:') !!}
                {!! Form::select('status', ['1' => 'Activo', '0' => 'Baja'], $notificacion->status, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Seleccionar ...',
                    'required',
                ]) !!}
            </section>
        </div>

        <div class="pie">
            {!! Form::submit('Guardar notificacion', ['class' => 'btn btn-success']) !!}
            {!! Form::close() !!}
        </div>

        <script>
            $(document).ready(function() {
                $('#sueldoBruto, #descuentos').on('input', function() {
                    var sueldoBruto = parseFloat($('#sueldoBruto').val());
                    var descuentos = parseFloat($('#descuentos').val());
                    var sueldoNeto = sueldoBruto - descuentos;
                    $('#sueldoNeto').val(sueldoNeto.toFixed(2));
                });
            });
        </script>

        <script>
            function formatNumber(inputId) {
                let input = document.getElementById(inputId);
                let value = input.value;
                let length = value.length;


                // Si el número tiene 8 o más dígitos, agregamos un punto después del sexto dígito
                if (length >= 8) {
                    let integerPart = value.substring(0, length - 2);
                    let decimalPart = value.substring(length - 2, length);
                    value = integerPart + '.' + decimalPart;

                }

                input.value = value;
            }
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
