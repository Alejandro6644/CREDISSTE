@extends('master')

@section('content')
    <link rel="stylesheet" href="{{ asset('/assets/css/crud/users/show.css') }}">

    <div class="container-fluid mt-4 principal rounded
     "
        style="margin: 0;
    margin-top: 0 !important;
    background-color: #ceffbf; 
    padding: 0 !important;
    width: 92%;
    ">
        <div class="w-100 cabecera">
            <h1>Detalle los pagos y usuarios</h1>
        </div>
        <div class="cuerpo ">
            <div class="row fila-color" style="width: 100%;">
                <div class="datos" style="width: 100%!important;">
                    <h2>ID de transacción: {!! $detalle_pago->encrypt_id !!}</h2>
                </div>
                <div class="datos" style="width: 100%!important;">
                    <h2>
                        Nombre del usuario:
                        <strong>
                            {!! $detalle_pago->usuario->primer_nombre !!}
                            {!! $detalle_pago->usuario->primer_apellido !!}
                        </strong>
                    </h2>
                </div>
                <div class="datos" style="width: 100%!important;">
                    <h2>
                        Datos de pago:
                        <strong>
                            {!! $detalle_pago->pago->identificador !!}
                        </strong>
                    </h2>
                </div>
                <div class="datos" style="width: 100%!important;">
                    <h2>
                        Sueldo bruto:
                        <strong>
                            {!! $detalle_pago->pago->sueldoBruto !!}
                        </strong>
                    </h2>
                </div>
                <div class="datos" style="width: 100%!important;">
                    <h2>
                        Descuentos de pago:
                        <strong>
                            {!! $detalle_pago->pago->descuentos !!}
                        </strong>
                    </h2>
                </div>
                <div class="datos" style="width: 100%!important;">
                    <h2>
                        Sueldo final:
                        <strong>
                            {!! $detalle_pago->pago->sueldoNeto !!}
                        </strong>
                    </h2>
                </div>
                <div class="datos" style="width: 100%!important;">
                    <h2>
                        Fecha de la transacción:
                        <strong>
                            {!! \Carbon\Carbon::parse($detalle_pago->pago->fecha)->format('d-m-Y') !!}

                        </strong>
                    </h2>
                </div>
            </div>
        </div>
        <div class="pie">
            <a href="{!! asset('/detallePagos') !!}" class="link-dark">
                <h3 class="regresar">Regresar CRUD detalle_pagos</h3>
            </a>
        </div>

    </div>
@endsection
