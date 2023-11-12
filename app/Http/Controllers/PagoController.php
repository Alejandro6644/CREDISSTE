<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = Pago::where('status', 1)->orderBy('fechaEmision')->get();
        return view('contenido.pagos.index')->with('pagos', $pagos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contenido.pagos.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'identificador' => 'required|unique:pagos,identificador,'
            ]);
            $pago = new     Pago;
            $pago->identificador = $request->identificador;
            $pago->fechaEmision = $request->fechaEmision;
            $pago->sueldoBruto = $request->sueldoBruto;
            $pago->descuentos = $request->descuentos;
            $pago->sueldoNeto = $request->sueldoNeto;
            $pago->encrypt_id                       = encrypt($pago->id);
            $pago->status = $request->input('status');

            $pago->save();
            return redirect('/pagos');
        } catch (\Exception $e) {
            $e = 'CLAVE DEBE SER ÚNICA';
            return redirect()->back()->withErrors($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show($encrypt_id)
    {
        $pago = Pago::where('encrypt_id', $encrypt_id)->first();
        return view('contenido.pagos.read')->with('pago', $pago);
    }

    public function edit($encrypt_id)
    {
        $pago = Pago::where('encrypt_id', $encrypt_id)->first();
        $fecha = \Carbon\Carbon::parse($pago->fechaEmision)->format('Y-m-d');
        return view('contenido.pagos.edit')->with('pago', $pago)
            ->with('fecha', $fecha);
    }

    public function update(Request $request, $encrypt_id)
    {
        try {
            $pago = Pago::where('encrypt_id', $encrypt_id)->first();
            $request->validate([
                'identificador' => 'required|unique:pagos,identificador,' . $pago->id
            ]);
            $pago->identificador = $request->identificador;
            $pago->fechaEmision = $request->fechaEmision;
            $pago->sueldoBruto = $request->sueldoBruto;
            $pago->descuentos = $request->descuentos;
            $pago->sueldoNeto = $request->sueldoNeto;
            $pago->encrypt_id = encrypt($pago->id);
            $pago->status = $request->input('status');
            $pago->update();

            return redirect('/pagos');
        } catch (\Exception $e) {
            $e = 'CLAVE DEBE SER ÚNICA';
            return redirect()->back()->withErrors($e);
        }
    }

    public function destroy($encrypt_id)
    {
        $pago = Pago::where('encrypt_id', $encrypt_id)->first();
        $pago->status = 0;
        $pago->save();
        return redirect('/pagos');
    }
}
