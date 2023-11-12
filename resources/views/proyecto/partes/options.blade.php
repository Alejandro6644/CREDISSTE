@extends('inicio')
@section('cuerpo')
    <link rel="stylesheet" href="{{ asset('/assets/css/onLogin/navOptions/estilos.css') }}">
    <script>
        function redirectToRoute(route) {
            window.location.href = route;
        }
    </script>
    <div style="display: flex;
        flex-direction: column;
        height: 100%;
        padding-top: 25px">
        <div class="row w-100 p-0" style="flex: 0 1 auto; justify-content:center">
            <div class="col-2 d-flex align-center justify-center" style="width: 18%; margin-left:10px">
                <div class="enviar-docs" onclick="redirectToRoute('{{ route('enviarDocs') }}')">
                    <i class="fa fa-home xd" aria-hidden="true"></i>
                    Enviar documentos
                </div>
            </div>
            <div class="col-3 d-flex align-center justify-center">
                <div class="dudas-docs " onclick="redirectToRoute('{{ route('dudasDocs') }}')">
                    <i class="fa fa-file-text" aria-hidden="true"></i>
                    ¿Dudas sobre documentación?
                </div>

            </div>
            <div class="col-3 d-flex align-center justify-center" style="width: 19%;">
                <div class="buzon-docs" style="text-align: end"  onclick="redirectToRoute('{{ route('buzon') }}')">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                    Buzón de notificaciones
                </div>

            </div>
            <div class="col-3 d-flex align-center justify-center" style="width: 19%;">
                <div class="sugerencias-docs" onclick="redirectToRoute('{{ route('sugerencia') }}')">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    Envio de sugerencias
                </div>
            </div>
            <div class="col-1 d-flex align-center justify-center" style="width: 166px;">
                <div class="nomina" onclick="redirectToRoute('{{ route('nominas') }}')">
                    <i class="fa fa-money" aria-hidden="true"></i>
                    Nomina
                </div>
            </div>
        </div>
        <div class="row w-100 ml-2 p-0 pt-5 pl-2 pb-0 " style="flex: 1 1 auto;">
            @yield('cuerpoOnLogin')
        </div>
    </div>
@endsection
