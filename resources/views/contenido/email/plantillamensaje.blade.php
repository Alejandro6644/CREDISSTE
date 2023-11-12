@extends('master')

@section('content')
    <link rel="stylesheet" href="{{ asset('/assets/css/crud/users/create.css') }}">

    <script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <div class="container-fluid mt-4 principal rounded
    "
        style="margin: 0;
        margin-top: 0 !important;
        background-color: #ceffbf; 
        padding: 0 !important;
        ">
        <div class="w-100 cabecera">
            <a href="{!! 'documentos/create' !!}">
                <p class="h2">Enviar correo eléctronico</p>
            </a>
        </div>
        <div class="cuerpo">
            <section style="justify-content: space-around">
                <h4 for="name">Mensaje:</h4>
                @if($var=='1')
                <div class="alert aler-success">
                    {!! $msj !!}
                </div>
                @else
                <div class="alert aler-danger">
                    {!! $msj !!}
                </div>
                @endif
            </section>          
        </div>
        <div class="pie align-self-center ">
            <a class="btn btn-outline btn-primary btn-lg" href="{!! asset('crud') !!}">
                {!! $mensaje_boton !!}
            </a>
        </div>
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
@endsection
