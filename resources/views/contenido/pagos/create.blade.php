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
                <h2>Crear pagos</h2>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <a href="{!! asset('/pagos') !!}" class="link-dark">
                    <h3 class="regresar">Regresar CRUD pagos</h3>
                </a>
            </div>
            @if ($errors->any())
                <div id="myAlert" class="alert alert-danger" role="alert" style="position: absolute">
                    <h4 class="alert-heading">Error</h4>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <hr>
                </div>
                <script>
                    setTimeout(function() {
                        $('#myAlert').fadeOut('slow');
                    }, 5000); // 5000 milisegundos = 5 segundos
                </script>
            @endif
        </div>
        <div class="cuerpo">
            {!! Form::open(['url' => '/pagos', 'id' => 'formulario']) !!}
            <section>
                {!! Form::label('identificador', 'Identificador del pago:') !!}
                {!! Form::text('identificador', null, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa el Identificador del pago',
                    'required',
                ]) !!}
            </section>
            <section>
                {!! Form::label('fechaEmision', 'Fecha del pago:') !!}
                {!! Form::date('fechaEmision', null, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa la Fecha del pago',
                    'required',
                ]) !!}
            </section>
            <section>
                {!! Form::label('sueldoBruto', 'Sueldo bruto del pago: $') !!}
                {!! Form::number('sueldoBruto', null, [
                    'id' => 'sueldoBruto',
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa el sueldo bruto del pago',
                    'required',
                    'step' => '0.01',
                    'maxlength' => '8', // Limita a 6 caracteres antes del punto y 2 después
                    'max' => '999999.99',
                    'oninput' => 'formatNumber(this.id)',
                    'type' => 'number',
                ]) !!}
            </section>

            <section>
                {!! Form::label('descuentos', 'Descuentos del pago: $') !!}
                {!! Form::number('descuentos', null, [
                    'id' => 'descuentos',
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa el descuentos del pago',
                    'required',
                    'step' => '0.01',
                    'maxlength' => '8', // Limita a 6 caracteres antes del punto y 2 después
                    'max' => '999999.99',
                    'oninput' => 'formatNumber(this.id)',
                    'type' => 'number',
                ]) !!}
            </section>

            <section>
                {!! Form::label('sueldoNeto', 'Sueldo neto del pago: $') !!}
                {!! Form::number('sueldoNeto', null, [
                    'id' => 'sueldoNeto',
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa el sueldo neto del pago',
                    'required',
                    'step' => '0.01',
                    'type' => 'number',
                    'maxlength' => '8', // Limita a 6 caracteres antes del punto y 2 después
                    'oninput' => 'if(this.value.length > 8) this.value = this.value.slice(0, 8);', // Deshabilita el campo cuando se alcanza el límite
                    'readonly' => true,
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
            {!! Form::submit('Guardar pago', ['class' => 'btn btn-success']) !!}
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
