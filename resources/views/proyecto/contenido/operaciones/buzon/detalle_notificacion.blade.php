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
            <div class="container-fluid contenido h-100">
                <div class="col-12 titulo-personal" style="flex: 0 1 auto;">
                    <h3 style="font-weight: bold">
                        {{ $notificacionRetorno->nombre }}
                    </h3>
                    <h3 style="font-weight: bold">
                        {{ $notificacionRetorno->fecha = \Carbon\Carbon::parse($notificacionRetorno->fecha)->format('Y-m-d') }}
                    </h3>
                </div>
                <div class="col-12 centrar-todo" style="flex: 1 1 auto;">
                    <span class="datos-individual" style="flex: 1 1 auto;">
                        <p class="mensaje-individual">
                            {{ $notificacionRetorno->contenido }}
                        </p>
                    </span>
                    @if ($documentos->count() > 0)
                        <h4>Documentos Enviados:</h4>
                        <div style="display: flex; justify-content: space-around; width:100%; overflow: auto">
                            @foreach ($documentos as $documento)
                                <strong class="datos-individual mt-2"
                                    style="width: 10rem;
                                        height: 19rem;
                                        
                                        ">
                                    <a href="{{ route('documentos.descargar.archivo', $documento->encrypt_id) }}"
                                        style="overflow-wrap: break-word;  word-wrap: break-word;  white-space: pre-wrap;">
                                        <img src="{{ asset('assets/images/pdf.png') }}" alt="Ejemplo"
                                            style="width: 10rem; height: 9rem">
                                        {{ $documento->nombre_archivo }}
                                    </a>
                                </strong>
                            @endforeach
                        </div>
                        {{--  --}}
                    @endif



                </div>
                @if ($trabajador_id !== null && $trabajador_id !== "")
                    <div class="col-12 centrar-todo mt-4">
                        <strong class="datos-individual" style="flex: 0 1 auto;">

                            <a
                                href="{{ route('notificaciones.responder.pdf', ['encrypt_id' => $notificacionRetorno->encrypt_id, 'trabajador_id' => $trabajador_id]) }}">
                                <h3> Responder </h3>
                            </a>
                            {{-- <h1>EL QUE LO ENVIÓ: {{$trabajador_id}}</h1> --}}

                        </strong>
                    </div>
                @endif



            </div>
        </div>
    </div>
@endsection
