<link rel="stylesheet" href="{{ asset('/assets/css/estilos.css') }}">
<div class="cabeceraOficial row ">
    <div class="col-2 d-flex justify-content-center align-items-center">
        <img src="/assets/images/gobiernoPNG.png" alt="gobierno" class="logo">
    </div>
    <div class="col-2 d-flex justify-content-center align-items-center p-0 m-0">
        <img src="/assets/images/logoChidoxd.png" alt="gobierno" class="logo">
    </div>
    <div class="col-4 d-flex justify-content-center align-items-center tituloCred">CREDISSSTE</div>
    <div class="col-4 d-flex justify-content-center align-items-center">
        @auth
        {!! Form::open(['url' => route('logout'), 'method' => 'POST']) !!}
        {!! Form::submit('CERRAR DE LA SESIÓN', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
        @endauth
    </div>
</div>
