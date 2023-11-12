<?php

namespace App\Http\Controllers;

use App\Models\DetallePago;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class PDFController extends Controller
{

    public function generarPDF(Request $request)
    {

        $detalle_pagos = DetallePago::where('status', 1)->orderBy('id_usuario')->get();
        $fechaActual = Carbon::now();
        $fechaFormateada = $fechaActual->format('d \d\e F \d\e Y');
        $encabezado = $request->encabezado;
        $opcion = $request->opcion;
        if ($opcion == '1') {
            return $this->renderizarResumen($encabezado, $detalle_pagos, $fechaFormateada);
        } elseif ($opcion == '2') {
            $this->renderizarPDF($encabezado, $detalle_pagos, $fechaFormateada);
        } else {
        }
    }

    public function renderizarResumen($encabezado, $detalle_pagos, $fechaFormateada)
    {
        $titulo = 'Sueldo Neto';
        switch ($encabezado) {
            case 'N':
                $titulo = 'Sueldo Neto';
                break;
            case 'B':
                $titulo = 'Sueldo Bruto';
                break;
            case 'D':
                $titulo = 'Sueldo Descuentos';
                break;
            default:
                $titulo = 'Sueldo Neto';
                break;
        }
        return view('proyecto.contenido.operaciones.pdf.documento')
            ->with('detalle_pagos', $detalle_pagos)
            ->with('encabezado', $encabezado)
            ->with('fechaFormateada', $fechaFormateada)
            ->with('titulo', $titulo);
    }

    public function renderizarPDF($encabezado, $detalle_pagos, $fechaFormateada)
    {
        // Renderiza la vista PDF en una variable
        $titulo = 'Sueldo Neto';
        switch ($encabezado) {
            case 'N':
                $titulo = 'Sueldo Neto';
                break;
            case 'B':
                $titulo = 'Sueldo Bruto';
                break;
            case 'D':
                $titulo = 'Sueldo Descuentos';
                break;
            default:
                $titulo = 'Sueldo Neto';
                break;
        }
         // $view = View::make(
        //     'proyecto.contenido.operaciones.pdf.documento',
        //     compact('detalle_pagos', 'encabezado', 'fechaFormateada', 'titulo')
        // ) ->render();
        // $pdf = \App::make('dompdf.wrapper');
        // $pdf->loadHTML($view);
        // var_dump('xd');
        // return $pdf->download('reporte.pdf');

        $pdfView = View::make(
            'proyecto.contenido.operaciones.pdf.documento',
            compact('detalle_pagos', 'encabezado', 'fechaFormateada', 'titulo')
        )->render();
        $pdfView = View::make(
            'proyecto.contenido.operaciones.pdf.documento',
            compact('detalle_pagos', 'encabezado', 'fechaFormateada', 'titulo')
        )->render();
        // Crea una nueva instancia de Dompdf
        $dompdf = new Dompdf();
        // Carga el contenido HTML en Dompdf
        $dompdf->loadHtml($pdfView);
        // Renderiza el contenido HTML en PDF
        $dompdf->render();
        // Genera el archivo PDF y lo guarda en el servidor
        $dompdf->stream('documento.pdf');
    }
}
