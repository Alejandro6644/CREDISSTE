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
            <form id="formulario" action="{{ route('enviar.correo') }}" method="POST" style="display: flex; justifu-content:center; flex-direction:column">
                @csrf
                <section style="justify-content: space-around">
                    <h4 for="name">Nombre:</h4>
                    <input class="form-control border-primary text-primary bg-light" type="text" id="nombre" name="nombre" required>
                </section>
                <section style="justify-content: space-around">
                    <h4 for="email">Correo electrónico:</h4>
                    <input class="form-control border-primary text-primary bg-light" type="email" id="destinatario" name="destinatario" required>
                </section>
                <section style="justify-content: space-around">
                    <h4 for="subject">Asunto:</h4>
                    <input class="form-control border-primary text-primary bg-light" type="text" id="asunto" name="asunto" required>
                </section>
                <section style="justify-content: space-around; height: 19rem !important;" >
                    <h4 for="message">Mensaje:</h4>
                    <textarea style="height: 17rem !important;"  class="form-control" id="contenido" name="contenido" rows="5" required></textarea>
                </section>
                <button type="submit" style="align-self: center; justify-self:center;font-size: 1.5rem" class="btn btn-success" >Enviar</button>
            </form>
        </div>
        <div class="pie align-self-center ">

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
