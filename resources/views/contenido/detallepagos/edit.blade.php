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
                <h2>Editar detalle_pago</h2>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <a href="{!! asset('/detallePagos') !!}" class="link-dark">
                    <h3 class="regresar">Regresar CRUD detallePagos</h3>
                </a>
            </div>
        </div>
        <div class="cuerpo">

            {!! Form::open([
                'method' => 'PATCH',
                'url' => '/detallePagos/' . $detalle_pago->encrypt_id,
                'enctype' => 'multipart/form-data',
            ]) !!}


            <section>
                {!! Form::label('id_usuario', 'Nombre del usuario: ') !!}
                {!! Form::select(
                    'id_usuario',
                    $usuarios->pluck('primer_nombre', 'encrypt_id')->all(),
                    $detalle_pago->usuario->encrypt_id,
                    [
                        'class' => 'form-control border-primary text-primary bg-light select-3rem',
                        'placeholder' => 'Seleccionar ...',
                        'required',
                    ],
                ) !!}
            </section>
            <section>
                {!! Form::label('identificador', 'Nombre del usuario: ') !!}
                {!! Form::select(
                    'identificador',
                    $pagos->pluck('identificador', 'encrypt_id')->all(),
                    $detalle_pago->pago->encrypt_id,
                    [
                        'class' => 'form-control border-primary text-primary bg-light select-3rem',
                        'placeholder' => 'Seleccionar ...',
                        'required',
                    ],
                ) !!}
            </section>
            <section>
                {!! Form::label('status', 'Estatus:') !!}
                {!! Form::select('status', ['1' => 'Activo', '0' => 'Baja'], $detalle_pago->status, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Seleccionar ...',
                    'required',
                ]) !!}
            </section>
        </div>

        <div class="pie">
            {!! Form::submit('Guardar detalle del pago', ['class' => 'btn btn-success']) !!}
            {!! Form::close() !!}
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('input[type="file"]').change(function(e) {
                    var fileName = e.target.files[0].name;
                    $('#nombre_detalle_pago').val(fileName);
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
