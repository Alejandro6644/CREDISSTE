@extends('master')

@section('content')
    <link rel="stylesheet" href="{{ asset('/assets/css/crud/users/create.css') }}">
    <script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        console.log('xddd');

        function cambiar_combo(id_pais) {
            $("#id_estado").empty();
            $("#id_municipio").empty();
            $("#id_institucion").empty();
            var ruta = "{{ asset('combo_entidad_pais') }}/" + id_pais;
            $.ajax({
                type: 'GET',
                url: ruta,
                success: function(data) {
                    var estados = data;
                    $('#id_estado').append('<option value="">Seleccionar ...</option>');
                    for (var i = 0; i < estados.length; i++) {
                        $('#id_estado').append('<option value="' + estados[i].encrypt_id + '">' + estados[i]
                            .nombre + '</option>');
                    }
                }
            });
        }

        function cambiar_combo2(id_estado) {
            $("#id_municipio").empty();
            $("#id_institucion").empty();
            var ruta = "{{ asset('combo_muni_entidad') }}/" + id_estado;
            console.log('RUTA: ' + ruta);
            console.log(id_estado);
            var municipios;
            $.ajax({
                type: 'GET',
                url: ruta,
                success: function(data) {
                    municipios = data;
                    $('#id_municipio').append('<option value="">Seleccionar ...</option>');
                    for (var i = 0; i < municipios.length; i++) {
                        $('#id_municipio').append('<option value="' + municipios[i].encrypt_id + '">' +
                            municipios[i].nombre + '</option>');
                    }
                }
            });
            cambiar_combo_institucion(id_estado);
        }

        function cambiar_combo_institucion(id_estado) {
            $("#id_institucion").empty();
            var ruta = "{{ asset('combo_entidad_institucion') }}/" + id_estado;
            console.log('RUTA: ' + ruta);
            console.log(id_estado);
            var instituciones;
            $.ajax({
                type: 'GET',
                url: ruta,
                success: function(data) {
                    instituciones = data;
                    $('#id_institucion').append('<option value="">Seleccionar ...</option>');
                    for (var i = 0; i < instituciones.length; i++) {
                        $('#id_institucion').append('<option value="' + instituciones[i].encrypt_id + '">' +
                            instituciones[i].nombre + '</option>');
                    }
                }
            });
        }
    </script>

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
                <h2>Crear Usuario</h2>
            </div>
            <div class="col-4 d-flex justify-content-end">
                <a href="{!! asset('/users') !!}" class="link-dark">
                    <h3 class="regresar">Regresar CRUD Usuarios</h3>
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
            {!! Form::open(['url' => '/users', 'id' => 'formulario']) !!}
            <section>
                {!! Form::label('primer_nombre', 'Nombre de la persona:') !!}
                {!! Form::text('primer_nombre', null, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa nombre de la persona',
                    'required',
                ]) !!}
            </section>
            <section>
                {!! Form::label('segundo_nombre', 'Segundo nombre de la persona:') !!}
                {!! Form::text('segundo_nombre', null, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa el segundo nombre de la persona',
                    'required',
                ]) !!}
            </section>
            <section>
                {!! Form::label('primer_apellido', 'Primer Apellido de la persona:') !!}
                {!! Form::text('primer_apellido', null, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa Primer Apellido de la persona',
                    'required',
                ]) !!}
            </section>
            <section>
                {!! Form::label('segundo_apellido', 'Segundo Apellido de la persona:') !!}
                {!! Form::text('segundo_apellido', null, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => 'Ingresa segundo Apellido de la persona',
                    'required',
                ]) !!}
            </section>
            <section>
                {!! Form::label('id_trabajador', 'ID de trabajador de la persona:') !!}
                {!! Form::text('id_trabajador', null, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => ' Ingresa ID de trabajador de la persona',
                    'required',
                ]) !!}
            </section>
            <section>
                {!! Form::label('password', 'Contraseña de la persona:') !!}
                {!! Form::text('password', null, [
                    'class' => 'form-control border-primary text-primary bg-light',
                    'placeholder' => ' Contraseña de la persona',
                    'required',
                ]) !!}
            </section>
            <section>
                {{-- INICIO AJAX  --}}
                {!! Form::label('id_pais', 'Pais al que pertenece:') !!}
                {!! Form::select('id_pais', $paises->pluck('nombre', 'encrypt_id')->all(), null, [
                    'class' => 'form-control border-primary text-primary bg-light select-3rem',
                    'placeholder' => 'Seleccionar ...',
                    'required',
                    'onchange' => 'cambiar_combo(this.value);',
                ]) !!}
            </section>
            <section>
                {!! Form::label('id_estado', 'Estado al que pertenece:') !!}
                {!! Form::select('id_estado', ['' => ''], null, [
                    'class' => 'form-control border-primary text-primary bg-light select-3rem',
                    'placeholder' => 'Seleccionar ...',
                    'required',
                    'onchange' => 'cambiar_combo2(this.value);',
                ]) !!}
            </section>
            <section>
                {!! Form::label('id_municipio', 'Municipio al que pertenece:') !!}
                {!! Form::select('id_municipio', ['' => ''], null, [
                    'id' => 'id_municipio',
                    'class' => 'form-control border-primary text-primary bg-light select-3rem',
                    'placeholder' => 'Seleccionar ...',
                    'required',
                ]) !!}
            </section>
            <section>
                {!! Form::label('id_institucion', 'Institucion a la que pertenece:') !!}
                {!! Form::select('id_institucion', ['' => ''], null, [
                    'class' => 'form-control border-primary text-primary bg-light select-3rem',
                    'placeholder' => 'Seleccionar ...',
                    'required',
                ]) !!}
            </section>
            <section>
                {!! Form::label('id_role', 'Role del empleado: ') !!}
                {!! Form::select('id_role', $roles->pluck('nombre', 'encrypt_id')->all(), null, [
                    'class' => 'form-control border-primary text-primary bg-light select-3rem',
                    'placeholder' => 'Seleccionar ...',
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
            {!! Form::submit('Guardar Persona', ['class' => 'btn btn-success']) !!}
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
