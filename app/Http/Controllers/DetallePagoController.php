<?php

namespace App\Http\Controllers;

use App\Models\DetallePago;
use App\Models\Pago;
use App\Models\User;
use Illuminate\Http\Request;

class DetallePagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detalle_pagos = DetallePago::where('status', 1)->orderBy('id_usuario')->get();
        return view('contenido.detallePagos.index')->with('detalle_pagos', $detalle_pagos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = User::select('encrypt_id', 'primer_nombre')->where('status', 1)->orderBy('primer_nombre')->get();
        $pagos = Pago::select('encrypt_id', 'identificador')->where('status', 1)->orderBy('identificador')->get();
        return view('contenido.detallePagos.create')
            ->with('usuarios', $usuarios)
            ->with('pagos', $pagos);
    }

    public function store(Request $request)
    {
        $detallePago = new DetallePago();
        $user =  User::select('id')->where('encrypt_id', $request->id_usuario)->first();
        $detallePago->id_usuario = $user->id;
        $pago =  Pago::select('id')->where('encrypt_id', $request->identificador)->first();
        $detallePago->id_pago = $pago->id;
        $detallePago->status = $request->input('status');
        $detallePago->encrypt_id                       = encrypt($detallePago->id);
        $detallePago->status = $request->input('status');

        $detallePago->save();
        return redirect('/detallePagos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\detallePago  $detallePago
     * @return \Illuminate\Http\Response
     */
    public function show($encrypt_id)
    {
        $detalle_pago = DetallePago::where('encrypt_id', $encrypt_id)->first();
        return view('contenido.detallePagos.read')->with('detalle_pago', $detalle_pago);
    }

    public function edit($encrypt_id)
    {
        $detalle_pago = DetallePago::where('encrypt_id', $encrypt_id)->first();
        $usuarios = User::select('encrypt_id', 'primer_nombre')->where('status', 1)->orderBy('primer_nombre')->get();
        $pagos = Pago::select('encrypt_id', 'identificador')->where('status', 1)->orderBy('identificador')->get();
        return view('contenido.detallePagos.edit')->with('detalle_pago', $detalle_pago)
            ->with('usuarios', $usuarios)
            ->with('pagos', $pagos);
    }

    public function update(Request $request, $encrypt_id)
    {
        $detallePago = DetallePago::where('encrypt_id', $encrypt_id)->first();
        $user =  User::select('id')->where('encrypt_id', $request->id_usuario)->first();
        $detallePago->id_usuario = $user->id;
        $pago =  Pago::select('id')->where('encrypt_id', $request->identificador)->first();
        $detallePago->id_pago =  $pago->id;
        $detallePago->status = $request->input('status');
        $detallePago->encrypt_id                       = encrypt($detallePago->id);
        $detallePago->status = $request->input('status');
        $detallePago->save();
        return redirect('/detallePagos');
    }

    public function destroy($encrypt_id)
    {
        $detallePago = DetallePago::where('encrypt_id', $encrypt_id)->first();
        $detallePago->status = 0;
        $detallePago->save();
        return redirect('/detallePagos');
    }

    public function verNomina()
    {
        $datos = DetallePago::where('status', 1)->orderBy('id_usuario')->get();
        $labels = $datos->pluck('usuario.primer_nombre'); // Obtener los nombres de los usuarios como etiquetas
        $valores = $datos->pluck('pago.sueldoNeto');
        $encabezado = 'Sueldo Neto';
        return view('proyecto.contenido.operaciones.nomina')->with([
            'labels' => $labels,
            'valores' => $valores,
            'encabezado' => $encabezado
        ]);
    }

    public function actualizarGrafica($opcion)
    {
        $labels = []; // Obtener los nombres de los usuarios
        $valores = []; // Obtener los sueldos netos o descuentos según la opción seleccionada
        $datos = DetallePago::where('status', 1)->orderBy('id_usuario')->get();

        // Lógica para obtener los datos según la opción seleccionada
        if ($opcion == 1) {
            // Obtener sueldos netos
            $labels = $datos->pluck('usuario.primer_nombre');
            $valores = $datos->pluck('pago.sueldoNeto');
            $encabezado = 'Sueldo Neto';
        } elseif ($opcion == 2) {
            // Obtener sueldos netos
            $labels = $datos->pluck('usuario.id_trabajador');
            $valores = $datos->pluck('pago.sueldoBruto');
            $encabezado = 'Sueldo Bruto';
        } elseif ($opcion == 3) {
            // Obtener descuentos
            $labels = $datos->pluck('usuario.id_trabajador');
            $valores = $datos->pluck('pago.descuentos');
            $encabezado = 'Descuentos';
        } else {
            // Obtener sueldos netos por defecto
            $labels = $datos->pluck('usuario.id_trabajador');
            $valores = $datos->pluck('pago.sueldoNeto');
            $encabezado = 'Sueldo Neto';
        }
        return response()->json(['labels' => $labels, 'valores' => $valores, 'encabezado' => $encabezado]);
    }
}
