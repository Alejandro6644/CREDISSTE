<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Municipio;
use App\Models\User;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipios = Municipio::where('status', 1)->orderBy('nombre')->get();
        return view('contenido.municipios.index')->with('municipios', $municipios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::select('encrypt_id','nombre')->where('status', 1)->orderBy('nombre')->get();
        return view('contenido.municipios.create')
            ->with('estados', $estados);
    }

    public function store(Request $request)
    {
        $municipio = new Municipio;
        $municipio->nombre = $request->nombre;
        $estado =  Estado::select('id')->where('encrypt_id', $request->id_estado)->first();
        $municipio->id_estado = $estado->id;
        $municipio->encrypt_id                       = encrypt($municipio->id);
        $municipio->status = $request->input('status');        

        $municipio->save();
        return redirect('/municipios');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\municipio  $municipio
     * @return \Illuminate\Http\Response
     */
    public function show($encrypt_id)
    {
        $municipio = Municipio::where('encrypt_id', $encrypt_id)->first();
        return view('contenido.municipios.read')->with('municipio', $municipio);
    }

    public function edit($encrypt_id)
    {
        $municipio = Municipio::where('encrypt_id', $encrypt_id)->first();
        $estados = Estado::select('encrypt_id','nombre')->where('status', 1)->orderBy('nombre')->get();
        return view('contenido.municipios.edit')
            ->with('municipio', $municipio)
            ->with('estados', $estados);
    }

    public function update(Request $request, $encrypt_id)
    {
        $municipio = Municipio::where('encrypt_id', $encrypt_id)->first();
        $municipio->nombre = $request->nombre;
        $estado =  Estado::select('id')->where('encrypt_id', $request->id_estado)->first();
        $municipio->id_estado = $estado->id;
        $municipio->encrypt_id                       = encrypt($municipio->id);
        $municipio->status = $request->input('status');          
        $municipio->save();
        return redirect('/municipios');
    }

    public function destroy($encrypt_id)
    {
        $municipio = Municipio::where('encrypt_id', $encrypt_id)->first();
        $municipio->status = 0;
        $municipio->save();
        return redirect('/municipios');
    }
}
