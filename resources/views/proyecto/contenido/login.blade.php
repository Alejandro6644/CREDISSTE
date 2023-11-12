@extends('inicio')
@section('cuerpo')
    <link rel="stylesheet" href="{{ asset('/assets/css/login/login.css') }}">



    <div class="login ">
        <form action="{{ route('loginAuth') }}" method="POST" class="d-flex row" style="height: 100%;">
            @csrf
            <div class="titulo">
                <h4>
                    ¡Bienvenido(a) a Credenciales del ISSSTE!
                    Por favor inicia sesión para acceder!
                </h4>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div id="myAlert" class="alert alert-danger" role="alert" style="position: absolute">
                            <h4 class="alert-heading">Error</h4>
                            <ul>
                                <li>{{ $error }}</li>
                            </ul>
                            <hr>
                        </div>
                    @endforeach
                    <script>
                        setTimeout(function() {
                            $('#myAlert').fadeOut('slow');
                        }, 5000); // 5000 milisegundos = 5 segundos
                    </script>
                @endif
            </div>
            <div class="cuerpo">
                <div class="mb-3">
                    <div id="id_trabajador_error" style="color: rgb(255, 255, 255);"></div>
                    <input type="text" class="form-control" id="id_trabajador" name="id_trabajador"
                        placeholder="INGRESA TU NÚMERO DE TRABAJADOR" required onblur="verificar(this)">

                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="INGRESA TU CONTRASEÑA" required>
                </div>
            </div>
            <div class="form-check" style="padding-left: 2.5em;">
                <input class="form-check-input " type="checkbox" value="" id="remember" name="remember">
                <label class="form-check-label ml-3" for="defaultCheck1">
                    RECORDAR SESIÓN
                </label>
            </div>

            <div class="pie  d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btnInicial w-100" style="margin-bottom: 20px;">Iniciar Sesion</button>
            </div>
            <span
                style="
            text-align: center;
            font-family: Montserrat;
            font-size: 18px;
            width: 100%;
            ">
                ¿Olvidaste tu contraseña?
                <br>
                Puedes recuperarla aquí
            </span>
            <div class="pie  d-flex justify-content-center align-items-center" style="padding: 0 7.5rem">
                <button type="submit" class="btn btnRecuperar w-100">Recuperar Contraseña</button>
            </div>
        </form>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function verificar(inputElement) {
            var id_trabajador = inputElement.value;
            var ruta = "{{ asset('validar_trabajador') }}/" + id_trabajador;
    
            $.ajax({
                url: ruta,
                type: 'GET',
                success: function(response) {
                    if (response.existe) {
                        $('#id_trabajador_error').text('');
                    } else {
                        $('#id_trabajador_error').text(
                            'El ID de trabajador no existe en nuestra base de datos.');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#id_trabajador_error').text(
                        'El ID de trabajador no existe en nuestra base de datos.');
                }
            });
        }
    </script>
    
@endsection
