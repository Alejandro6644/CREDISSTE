@extends('proyecto.partes.options')
@section('cuerpoOnLogin')
    <link rel="stylesheet" href="{{ asset('/assets/css/onLogin/sugerencias/estilos.css') }}">
    <div class="dudas-docs-container p-5 pt-0">
        <span class="titulo-container-dudas-docs centrar-todo mb-2">
            Responde a la petición que has recibido:
        </span>
        @if (isset($e))
            <div class="alert alert-danger" style="position: absolute">
                Error al subir el archivo, revise sus datos:
                {{ $e->getMessage() }}
            </div>
        @endif
        <div class="row">
            <div class="col-3" id="archivos"
                style="color:black !important; display: flex;
            justify-content: space-between; width: 100%;
            padding: 0.5rem;
            ">

            </div>
        </div>
        <form class="w-100 h-100 mt-4 p-0 contenido-central"
            action="{{ route('notificaciones.enviar.respuesta', ['encrypt_id' => $notificacionRetorno, 'eid_trabajador' => $eidtrabajador]) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" class="form-control bg-light" name="titulo" value=""
                placeholder="Titulo de la notificación" />
            <textarea class="form-control informacion-documentos" id="exampleFormControlTextarea1" name="contenido" rows="3"
                style="box-shadow: 10px 5px 5px black;" placeholder="Escribe aquí tu mensaje"required></textarea>

            <div class="upload-footer mt-2">
                <label for="archivosInput" class="cargar" style="background-color: #24A148; border-radius:40px">Cargar
                    Archivo</label>
                <input id="archivosInput" type="file" name="archivos[]" multiple accept="application/pdf"
                    style="display: none;" >
            </div>
            <div class="pie-boton">
                <button type="submit" class="btn btn-danger">Enviar</button>
            </div>
            {{-- <h1>EL QUE LO ENVIÓ: {{$eidtrabajador}}</h1> --}}

        </form>

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

                // Crear un contenedor para el nombre del archivo, la imagen y el botón de borrar
                const contenedorArchivo = document.createElement('div');
                contenedorArchivo.style.display = 'flex';
                contenedorArchivo.style.justifyContent = 'flex-start';
                contenedorArchivo.style.width = '100%';
                contenedorArchivo.style.alignItems = 'center';
                contenedorArchivo.style.padding = '10px';
                contenedorArchivo.style.maxWidht = '25%';


                // Elemento para el nombre del archivo
                const nombreArchivoDiv = document.createElement('div');
                nombreArchivoDiv.innerText = nombreArchivo;
                nombreArchivoDiv.style.color = 'black';
                nombreArchivoDiv.style.display = 'flex';
                nombreArchivoDiv.style.alignItems = 'center';

                // Elemento para la imagen (cambia 'ruta_de_la_imagen' por la ruta de tu imagen)
                const imagen = document.createElement('img');
                imagen.src = '/assets/images/pdf.png'; // Cambia esto por la ruta de tu imagen
                imagen.style.width = '3.5rem';
                imagen.style.height = '3.5rem';

                // Elemento para el botón de borrar
                const botonBorrar = document.createElement('button');
                botonBorrar.innerText = 'Borrar';
                botonBorrar.style.backgroundColor = 'red';
                botonBorrar.style.color = 'white';
                botonBorrar.style.border = 'none';
                botonBorrar.style.borderRadius = '5px';
                botonBorrar.style.padding = '5px';
                botonBorrar.style.cursor = 'pointer';

                // Agregar el evento de clic al botón de borrar
                botonBorrar.addEventListener('click', function() {
                    // Elimina el contenedor del archivo al hacer clic en el botón de borrar
                    contenedorArchivo.remove();
                    // También puedes agregar aquí la lógica para eliminar el archivo de la lista de archivos a enviar si es necesario
                });

                // Agregar el nombre del archivo, la imagen y el botón de borrar al contenedor
                contenedorArchivo.appendChild(nombreArchivoDiv);
                contenedorArchivo.appendChild(imagen);
                contenedorArchivo.appendChild(botonBorrar);

                // Agregar el contenedor al div principal
                archivosDiv.appendChild(contenedorArchivo);
            }

        }
    </script>
@endsection
