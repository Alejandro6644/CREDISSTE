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
                <h2>Crear correos</h2>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <a href="{!! asset('/correos') !!}" class="link-dark">
                    <h3 class="regresar">Regresar CRUD correos</h3>
                </a>
            </div>
        </div>
        <div class="cuerpo">
            {!! Form::open(['url' => '/correos', 'id' => 'formulario', 'enctype' => 'multipart/form-data']) !!}

            <section>
                {!! Form::label('origen', 'origen del correo:') !!}
                {!! Form::email('origen', null, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa el origen del correo',
                    'required',
                ]) !!}
            </section>
            <section>
                {!! Form::label('destinatario', 'destinatario del correo:') !!}
                {!! Form::email('destinatario', null, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa la destinatario del correo',
                    'required',
                ]) !!}
            </section>
            <section>
                {!! Form::label('fecha', 'Fecha del correo:') !!}
                {!! Form::date('fecha', null, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa la Fecha del correo',
                    'required',
                ]) !!}
            </section>
            <section>
                {!! Form::label('contenido', 'contenido del correo:') !!}
                {!! Form::text('contenido', null, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa la contenido del correo',
                    'required',
                ]) !!}
            </section>
            <section>
                {!! Form::label('status', 'Estatus:') !!}
                {!! Form::select('status', ['1' => 'Activo', '0' => 'Baja'], null, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Seleccionar ...',
                    'required',
                ]) !!}
            </section>
        </div>

        <div class="pie">
            {!! Form::submit('Guardar correo', ['class' => 'btn btn-success']) !!}
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
