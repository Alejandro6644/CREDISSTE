<!DOCTYPE html>
<html>

<head>
    <title>Factura</title>
    {{-- <style>
        :root {
            --font-color: black;
            --highlight-color: #60D0E4;
            --header-bg-color: #B8E6F1;
            --footer-bg-color: #BFC0C3;
            --table-row-separator-color: #BFC0C3;
        }
        *{
            color: black
        }   

        @page {
            size: US-Letter;
            margin: 8cm 0 3cm 0;

            @top-left {
                content: element(header);
            }

            @bottom-left {
                content: element(footer);
            }
        }

        body {
            margin: 0;
            padding: 1cm 2cm;
            color: var(--font-color);
            font-family: 'Montserrat', sans-serif;
            font-size: 10pt;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        hr {
            margin: 1cm 0;
            height: 0;
            border: 0;
            border-top: 1mm solid var(--highlight-color);
        }

        header {
            height: 8cm;
            padding: 0 2cm;
            position: running(header);
            background-color: var(--header-bg-color);
        }

        header .headerSection {
            display: flex;
            justify-content: space-between;
        }

        header .headerSection:first-child {
            padding-top: .5cm;
        }

        header .headerSection:last-child {
            padding-bottom: .5cm;
        }

        header .headerSection div:last-child {
            width: 35%;
        }

        header .logoAndName {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header .logoAndName svg {
            width: 1.5cm;
            height: 1.5cm;
            margin-right: .5cm;
        }

        header .headerSection .invoiceDetails {
            padding-top: .5cm;
        }

        header .headerSection h3 {
            margin: 0 .75cm 0 0;
            color: var(--highlight-color);
        }

        header .headerSection div:last-of-type h3:last-of-type {
            margin-top: .5cm;
        }

        header .headerSection div p {
            margin-top: 2px;
        }

        header h1,
        header h2,
        header h3,
        header p {
            margin: 0;
        }

        header .invoiceDetails,
        header .invoiceDetails h2 {
            text-align: right;
            font-size: 1em;
            text-transform: none;
        }

        header h2,
        header h3 {
            text-transform: uppercase;
        }

        header hr {
            margin: 1cm 0 .5cm 0;
        }
    </style> --}}

    <style>
        body {
            display: flex;
            flex-direction: column;
            background-color: #BFC0C3
        }

        header {
            background-color: #13322b;
            flex: 0 1 20vh;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            flex-direction: column;
        }

        footer {
            background-color: #9d2449;
            flex: 0 1 5vh;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        a {
            color: white;
        }

        main {
            flex: 1 1 70vh;
            background-color: aliceblue;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            color: black;
            width: 100%;
        }

        aside {
            flex: 0 1 5vh;
            color: black;
            display: flex;
            justify-content: space-between;
            flex-direction: row;
            align-items: center;
            color: white;
        }

        th {
            color: #9d2449
        }

        .final {
            margin-top: 2.5rem;
            display: flex;
            justify-content: end;
            width: 80%;
            background-color: #aa3a5c;
            color: white;
        }
        td{
            text-align: center;
            padding-bottom: 1.5rem;
        }
    </style>
</head>

<body>
    <header>
        <div class="logoAndName">
            <img src="{{ asset('logoChidoxd.png') }}" alt="gobierno" class="logo" style="height: 10rem;width: 20rem;">

        </div>
        <div class="invoiceDetails" style="display: flex; justify-content:space-between; width: 100%">
            <h2>Detalle </h2>
            <p>
                {!! $fechaFormateada !!}
            </p>
        </div>
        <hr />
    </header>

    <footer>
        <a href="https://www.gob.mx/issste">
            companywebsite.com
        </a>
        <a href="mailto:quejas@issste.gob.mx">
            quejas@issste.gob.mx
        </a>
        <span>
            317.123.8765
        </span>
        <span>
            Toluca de Lerdo, Méx. · 722 211 8993
        </span>
    </footer>

    <main>
        <table id="xd" class="table table-hover p-3 w-100" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Identificador</th>
                    <th>Fecha de pago</th>
                    @if ($encabezado == 'B' || $encabezado == 'D')
                        <th>Sueldo Bruto</th>
                    @endif
                    <th>Sueldo Neto del Empleado</th>
                    @if ($encabezado == 'D')
                        <th>Sueldo Bruto</th>
                    @endif
                </tr>
            </thead>
            @php
                $counter = 1;
            @endphp
            <tbody id="tabla-body">
                @foreach ($detalle_pagos as $detalle_pago)
                    <tr class="content-row">
                        <td>
                            <span class="content-data">
                                {!! $counter !!}
                            </span>
                        </td>
                        <td>
                            <span class="content-data">
                                {!! $detalle_pago->usuario->primer_nombre !!}
                                {!! $detalle_pago->usuario->segundo_nombre !!}
                            </span>
                        </td>
                        <td>
                            <span class="content-data">
                                {!! $detalle_pago->pago->identificador !!}
                            </span>
                        </td>
                        <td>
                            <span class="content-data">
                                {!! \Carbon\Carbon::parse($detalle_pago->pago->fecha)->format('d-m-Y') !!}
                            </span>
                        </td>
                        @if ($encabezado == 'B' || $encabezado == 'D')
                            <td>
                                <span class="content-data">
                               $     {!! $detalle_pago->pago->sueldoBruto !!}
                                </span>
                            </td>
                        @endif
                        <td>
                            <span class="content-data">
                              $  {!! $detalle_pago->pago->sueldoNeto !!}
                            </span>
                        </td>
                        @if ($encabezado == 'D')
                            <td>
                                <span class="content-data">
                                  $  {!! $detalle_pago->pago->descuentos !!}
                                </span>
                            </td>
                        @endif
                    </tr>
                    @php
                        $counter = $counter + 1;
                    @endphp
                @endforeach
            </tbody>
        </table>
        <!-- The summary table contains the subtotal, tax and total amount. -->
        <div class="final">
            <table class="summary">
                <tr class="total">
                    <th style="color: black">
                        Total de {!! $titulo !!}
                    </th>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td style="padding: 0 !important">
                        @php
                            $totalNeto = 0;
                            $totalBruto = 0;
                            $totalDescuentos = 0;
                        @endphp

                        @foreach ($detalle_pagos as $detalle_pago)
                            @php
                                $totalNeto = $totalNeto + $detalle_pago->pago->sueldoBruto;
                                $totalBruto = $totalBruto + $detalle_pago->pago->sueldoNeto;
                                $totalDescuentos = $totalDescuentos + $detalle_pago->pago->descuentos;
                            @endphp
                        @endforeach

                        @if ($encabezado == 'N')
                           $ {!! $totalNeto !!}
                        @endif
                        @if ($encabezado == 'B')
                           $ {!! $totalBruto !!}
                        @endif
                        @if ($encabezado == 'D')
                           $ {!! $totalDescuentos !!}
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </main>
    <aside>
        <div
            style="   display: flex;
        justify-content: space-between;
        flex-direction: row;
        align-items: center; width:100%; color:black">
            <div>
                <b>Terms &amp; Conditions</b>
                <p>
                    Proyecto de Alejandro Emmanuel Gonzalez Ramirez
                </p>
            </div>
            <div>
                <b>Datos</b>
                <ul>
                    <li>No de control</li>
                    <li>19280735</li>
                </ul>
            </div>
        </div>
    </aside>

</body>

</html>
