@extends('proyecto.partes.options')
@section('cuerpoOnLogin')
    <link rel="stylesheet" href="{{ asset('/assets/css/onLogin/enviarDocs/estilos.css') }}">

    <div class="col-3">
        <div class="datos">
            <div class="informacion">
                @if (isset($e))
                    <div class="alert alert-danger" style="position: absolute">
                        Error al subir el archivo, revise sus datos:
                        {{ $e->getMessage() }}
                    </div>
                @endif
                <div class="d-flex space-around w-100 align-items-center mb-3">
                    <i class="fa fa-info-circle" aria-hidden="true" style="color: black !important;"></i>
                    <h4 class="ml-3 mb-0" style="color: black !important;">Recuerda subir:</h4>
                </div>
                <ul class="lista-info">
                    <li>
                        CURP
                    </li>
                    <li>
                        FOTOGRAFÍA TAMAÑO INFANTIL
                    </li>
                    <li>
                        INE
                    </li>
                    <li>
                        ÚLTIMO TALÓN DE PAGO
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-6">
        <form class="subirDocs" action="{{ route('enviarDocumentos') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h3>¡BIENVENIDO!<br>Por favor coloca los documentos correspondientes</h3>
            <div class="archivos" style="background-color: #9D2449">Sube tus archivos a continuación</div>
            <div class="archivo mt-4">
                <div class="upload-head"></div>
                <div class="upload-body">
                    <div class="contenedor-imagen-upload">
                        <img src="/assets/images/arrow-down.png" alt="" class="upload-arrow">
                    </div>
                    Arrastra tus archivos aquí<br>
                    o carga tu archivo
                </div>
                <div class="upload-footer mt-2">
                    <label for="archivosInput" class="cargar" style="background-color: #24A148; border-radius:40px">Cargar
                        Archivo</label>
                    <input id="archivosInput" type="file" name="archivos[]" multiple accept="application/pdf"
                        style="display: none;" required>
                </div>
            </div>
            <button class="btn enviar mt-5" type="submit" style="background-color: #13322B;border-radius:40px">Enviar
                Datos</button>
        </form>

    </div>
    <div class="col-3" id="archivos" style="color:black !important">

    </div>

    <script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const archivosInput = document.getElementById('archivosInput');
        const archivosDiv = document.getElementById('archivos');

        archivosInput.addEventListener('change', mostrarNombresArchivos);

        function mostrarNombresArchivos() {
            archivosDiv.innerHTML = ''; // Limpiar el contenido anterior

            for (let i = 0; i < archivosInput.files.length; i++) {
                const archivo = archivosInput.files[i];
                const nombreArchivo = archivo.name;
                // Crear un contenedor para el nombre del archivo y la imagen
                const contenedorArchivo = document.createElement('div');
                contenedorArchivo.style.display = 'flex';
                contenedorArchivo.style.justifyContent = 'space-between';
                contenedorArchivo.style.width = '100%';
                contenedorArchivo.style.alignItems = 'center';

                // Elemento para el nombre del archivo
                const nombreArchivoDiv = document.createElement('div');
                nombreArchivoDiv.innerText = nombreArchivo;
                // Elemento para la imagen (cambia 'ruta_de_la_imagen' por la ruta de tu imagen)
                nombreArchivoDiv.style.color = 'black';
                nombreArchivoDiv.style.display = 'flex';
                nombreArchivoDiv.style.alignItems = 'center';

                const imagen = document.createElement('img');
                imagen.src = '/assets/images/pdf.png'; // Cambia esto por la ruta de tu imagen
                imagen.style.width = '3.5rem';
                imagen.style.height = '3.5rem';

                // Agregar el nombre del archivo y la imagen al contenedor
                contenedorArchivo.appendChild(nombreArchivoDiv);
                contenedorArchivo.appendChild(imagen);
                // Agregar el contenedor al div principal
                archivosDiv.appendChild(contenedorArchivo);
            }
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
@endsection
