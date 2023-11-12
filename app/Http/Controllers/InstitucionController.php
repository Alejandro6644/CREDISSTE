<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Institucion;
use Illuminate\Http\Request;

class InstitucionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instituciones = Institucion::where('status', 1)->orderBy('nombre')->get();
        return view('contenido.instituciones.index')->with('instituciones', $instituciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::select('encrypt_id', 'nombre')->where('status', 1)->orderBy('nombre')->get();
        return view('contenido.instituciones.create')
            ->with('estados', $estados);
    }

    public function store(Request $request)
    {
        $institucion = new Institucion;
        $institucion->nombre = $request->nombre;
        $estado =  Estado::select('id')->where('encrypt_id', $request->id_estado)->first();
        $institucion->id_estado = $estado->id;
        $institucion->encrypt_id                       = encrypt($institucion->id);
        $institucion->status = $request->input('status');

        $institucion->save();
        return redirect('/instituciones');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function show($encrypt_id)
    {
        $institucion = Institucion::where('encrypt_id', $encrypt_id)->first();
        return view('contenido.instituciones.read')->with('institucion', $institucion);
    }

    public function edit($encrypt_id)
    {
        $institucion = Institucion::where('encrypt_id', $encrypt_id)->first();
        $estados = Estado::select('encrypt_id', 'nombre')->where('status', 1)->orderBy('nombre')->get();
        return view('contenido.instituciones.edit')
            ->with('institucion', $institucion)
            ->with('estados', $estados);
    }

    public function update(Request $request, $encrypt_id)
    {
        $institucion = Institucion::where('encrypt_id', $encrypt_id)->first();
        $institucion->nombre = $request->nombre;
        $estado =  Estado::select('id')->where('encrypt_id', $request->id_estado)->first();
        $institucion->id_estado = $estado->id;
        $institucion->encrypt_id                       = encrypt($institucion->id);
        $institucion->status = $request->input('status');
        $institucion->save();
        return redirect('/instituciones');
    }

    public function destroy($encrypt_id)
    {
        $institucion = Institucion::where('encrypt_id', $encrypt_id)->first();
        $institucion->status = 0;
        $institucion->save();
        return redirect('/instituciones');
    }
}
