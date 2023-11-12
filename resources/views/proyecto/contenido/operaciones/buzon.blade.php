@extends('proyecto.partes.options')
@section('cuerpoOnLogin')
    <link rel="stylesheet" href="{{ asset('/assets/css/onLogin/buzon/estilos.css') }}">
    <div class="dudas-docs-container p-5 pt-0">
        <span class="titulo-container-dudas-docs centrar-todo mb-2">
            En esta sección encontrarás los mensajes que ha enviado el ISSSTE, con la finalidad de informarte acerca de los
            procesos de solicitud de que hayas iniciado.
        </span>

        <div class="row">
        </div>
        <div class="informacion-documentos mt-4 p-0">
            <div class="container-fluid p-0">
                <div>
                    @if ($notificaciones->isEmpty())
                        <div class="container-fluid d-flex justify-content-center align-items-center">
                            <h1 style="color: black; text-align:center">No hay datos disponibles por mostrar</h1>
                        </div>
                    @else
                        @foreach ($notificaciones as $notificacion)
                                <div class="notificacion"  onclick="redirectToRoute('{{ route('detalleNotificacion', ['notificacion' => $notificacion->encrypt_id]) }}')">
                                    <span style="color: black">
                                        {{ $notificacion->nombre }}
                                    </span>
                                    <span style="color: black">
                                        {{ $notificacion->fecha = \Carbon\Carbon::parse($notificacion->fecha)->format('Y-m-d') }}
                                    </span>
                                </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
