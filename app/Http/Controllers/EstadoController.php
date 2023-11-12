<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Institucion;
use App\Models\Municipio;
use App\Models\Pais;

use Illuminate\Http\Request;

class EstadoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = Estado::where('status', 1)->orderBy('nombre')->get();
        return view('contenido.estados.index')->with('estados', $estados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises = Pais::select('encrypt_id','nombre')->where('status', 1)->orderBy('nombre')->get();
        return view('contenido.estados.create')
        ->with('paises',$paises);
    }

    public function store(Request $request)
    {
        $estado = new Estado();
        $estado->nombre = $request->nombre;
        $pais =  Pais::select('id')->where('encrypt_id', $request->id_pais)->first();
        $estado->id_pais = $pais->id;
        $estado->encrypt_id                       = encrypt($estado->id);
        $estado->status = $request->input('status');

        $estado->save();
        return redirect('/estados');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function show($encrypt_id)
    {
        $estado = Estado::where('encrypt_id', $encrypt_id)->first();
        return view('contenido.estados.read')->with('estado', $estado);
    }

    public function edit($encrypt_id)
    {
        $estado = Estado::where('encrypt_id', $encrypt_id)->first();
        $paises = Pais::select('encrypt_id','nombre')->where('status', 1)->orderBy('nombre')->get();        
        return view('contenido.estados.edit')->with('estado', $estado)
        ->with('paises',$paises);
    }

    public function update(Request $request, $encrypt_id)
    {
        $estado = Estado::where('encrypt_id', $encrypt_id)->first();
        $estado->nombre = $request->nombre;
        $pais =  Pais::select('id')->where('encrypt_id', $request->id_pais)->first();
        $estado->id_pais = $pais->id;
        $estado->encrypt_id                       = encrypt($estado->id);
        $estado->status = $request->input('status');     
        $estado->save();
        return redirect('/estados');
    }

    public function destroy($encrypt_id)
    {
        $estado = Estado::where('encrypt_id', $encrypt_id)->first();
        $estado->status = 0;
        $estado->save();
        return redirect('/estados');
    }


    public function cambia_combo_entidad($id_pais){
        $pais = Pais::
        select('id')
        ->where('encrypt_id',$id_pais)
        ->first();
        $estados = Estado::
        select('encrypt_id','nombre')
        ->where('id_pais',$pais->id)
        ->orderBy('nombre')
        ->get();
        return $estados;
    }

    public function cambia_combo_municipio($id_estado){
        $estado = Estado::
        select('id')
        ->where('encrypt_id',$id_estado)
        ->first();
        $municipios = Municipio::
        select('encrypt_id','nombre')
        ->where('status', 1)
        ->where('id_estado',$estado->id)
        ->orderBy('nombre')
        ->get();
        return $municipios;
    }

    public function cambia_combo_institucion($id_estado){
        $estado = Estado::
        select('id')
        ->where('encrypt_id',$id_estado)
        ->first();
        $instituciones = Institucion::
        select('encrypt_id','nombre')
        ->where('status', 1)
        ->where('id_estado',$estado->id)
        ->orderBy('nombre')
        ->get();
        return $instituciones;
    }

}
