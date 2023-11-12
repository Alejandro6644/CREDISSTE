@extends('proyecto.partes.options')
@section('cuerpoOnLogin')
    <link rel="stylesheet" href="{{ asset('/assets/css/onLogin/dudasDocs/estilos.css') }}">
    <div class="dudas-docs-container p-0">
        <span class="titulo-container-dudas-docs centrar-todo mb-2">
            ¿Tienes dudas?
            <br>
            ¡No te preocupes! Acontinuación se enlistará la documentación necesaria para el trámite
        </span>
        <div class="col-12 cuadro-dudas centrar-todo mb-2">
            Selecciona aquel con el que tengas dudas
        </div>
        <div class="row">

        </div>
        <div class="informacion-documentos mt-4">
            <div class="row h-100">
                <div class="col-3 lista-documentos p-0" style="border: 1px solid black;box-shadow: 10px 5px 5px black;">
                    <ul class="p-0">
                        <li class="documento" data-documento="curp">
                            CURP
                        </li>
                        <li class="documento" data-documento="fotografia">
                            FOTOGRAFIA
                        </li>
                        <li class="documento" data-documento="ine">
                            INE
                        </li>
                        <li class="documento" data-documento="Talon de Pago">
                            ULTIMO TALON DE PAGO
                        </li>
                    </ul>
                </div>
                {{-- <div class="col-8 informacion-documentos  ml-4 mr-3 " style="background-color: #D8F6D8; color:black">
                    <div class="row w-100 h-100 " style="color: black">
                        <div class="col-6 centrar-todo  pt-5" style="border-right: .3125rem solid black;color: black;">
                            <div class="titulo-documento-interno centrar-todo " style=" flex: 0 1 auto;">
                                Curp
                            </div>
                            <span class="p-4 w-100" style="color:black; font-size:2rem; height:20.375rem;flex: 1 1 auto; ">
                                La Clave Única de Registro de Población es un único
                                de identidad de 18 caracteres utilizado para identificar
                                oficialmente tanto a residentes como a ciudadanos mexicanos
                                de todo el país.​
                            </span>
                        </div>
                        <div class="col-6 centrar-todo pt-5">
                            <div class="titulo-documento-interno centrar-todo" style=" flex: 0 1 auto;">
                                Ejemplo
                            </div>
                            <span class="p-4 w-100 centrar-todo" style=" flex: 1 1 auto;">
                                <img src="{{ asset('assets/images/CURP.jpg') }}" alt="Ejemplo">
                            </span>
                        </div>
                    </div>
                </div> --}}
                <div id="descripcion-documento" class="col-8 informacion-documentos ml-4 mr-3" style="background-color: #D8F6D8; color:black;overflow:auto; ">
                    <!-- Aquí se mostrará la descripción dinámica del documento seleccionado -->
                </div>
                

            </div>
        </div>
    </div>

    <script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.documento').click(function() {
                var documento = $(this).data('documento');

                $.ajax({
                    url: '/obtener-descripcion-documento/' + documento,
                    type: 'GET',
                    success: function(response) {
                        if (response.descripcion) {
                            var descripcion = response.descripcion;
                            var imagen =
                            '{{ asset('assets/images/CURP.jpg') }}'; // Ruta de la imagen por defecto

                            if (documento === 'curp') {
                                imagen =
                                '{{ asset('assets/images/CURP.jpg') }}'; // Ruta de la imagen para CURP
                            } else if (documento === 'fotografia') {
                                imagen =
                                '{{ asset('assets/images/FOTOGRAFIA.png') }}'; // Ruta de la imagen para FOTOGRAFIA
                            } else if (documento === 'ine') {
                                imagen =
                                '{{ asset('assets/images/INE.jpg') }}'; // Ruta de la imagen para INE
                            } else if (documento === 'talon-pago') {
                                imagen =
                                '{{ asset('assets/images/ULTIMO_TALON_DE_PAGO.jpg') }}'; // Ruta de la imagen para ULTIMO TALON DE PAGO
                            }

                            var html = `
            <div class="row w-100 h-100" style="color: black">
              <div class="col-6 centrar-todo pt-5" style="border-right: .3125rem solid black;color: black;">
                <div class="titulo-documento-interno centrar-todo" style="flex: 0 1 auto;">${documento}</div>
                <span class="p-4 w-100" style="color:black; font-size:2rem; height:20.375rem;flex: 1 1 auto;">${descripcion}</span>
              </div>
              <div class="col-6 centrar-todo pt-5">
                <div class="titulo-documento-interno centrar-todo" style="flex: 0 1 auto;">Ejemplo</div>
                <span class="p-4 w-100 centrar-todo" style="flex: 1 1 auto;">
                  <img src="${imagen}" alt="Ejemplo" style="height: 25.188rem; width: 41.188rem;">
                </span>
              </div>
            </div>
          `;

                            $('#descripcion-documento').html(html);
                        } else if (response.error) {
                            $('#descripcion-documento').html(response.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
