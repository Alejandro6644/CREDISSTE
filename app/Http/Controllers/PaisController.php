<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paises = Pais::where('status', 1)->orderBy('nombre')->get();
        return view('contenido.paises.index')->with('paises', $paises);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contenido.paises.create');
    }

    public function store(Request $request)
    {
        $pais = new Pais;
        $pais->nombre = $request->nombre;
        $pais->clave = $request->clave;
        $pais->encrypt_id                       = encrypt($pais->id);
        $pais->status = $request->input('status');
        $pais->save();
        return redirect('/paises');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function show($encrypt_id)
    {
        $pais = Pais::where('encrypt_id', $encrypt_id)->first();
        return view('contenido.paises.read')->with('pais', $pais);
    }

    public function edit($encrypt_id)
    {
        $pais = Pais::where('encrypt_id', $encrypt_id)->first();
        return view('contenido.paises.edit')->with('pais', $pais);
    }

    public function update(Request $request, $encrypt_id)
    {
        $pais = Pais::where('encrypt_id', $encrypt_id)->first();
        $pais->nombre = $request->nombre;
        $pais->clave = $request->clave;
        $pais->encrypt_id                       = encrypt($pais->id);
        $pais->status = $request->input('status');
        $pais->update();
        return redirect('/paises');
    }

    public function destroy($encrypt_id)
    {
        $pais = Pais::where('encrypt_id', $encrypt_id)->first();
        $pais->status = 0;
        $pais->save();
        return redirect('/paises');
    }
}
