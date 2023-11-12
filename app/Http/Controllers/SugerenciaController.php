<?php

namespace App\Http\Controllers;

use App\Models\Sugerencia;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class SugerenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sugerencias = Sugerencia::where('status', 1)->orderBy('contenido')->get();
        return view('contenido.sugerencias.index')->with('sugerencias', $sugerencias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = User::select('encrypt_id', 'primer_nombre')->where('status', 1)->orderBy('primer_nombre')->get();
        return view('contenido.sugerencias.create')
            ->with('usuarios', $usuarios);
    }

    public function store(Request $request)
    {
        $sugerencia = new Sugerencia;
        $sugerencia->contenido = $request->contenido;
        $sugerencia->fecha = $request->fecha;
        $sugerencia->encrypt_id                       = encrypt($sugerencia->id);
        $user =  User::select('id')->where('encrypt_id', $request->id_usuario)->first();
        $sugerencia->id_usuario = $user->id;
        $sugerencia->status = $request->input('status');

        $sugerencia->save();
        return redirect('/sugerencias');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sugerencia  $sugerencia
     * @return \Illuminate\Http\Response
     */
    public function show($encrypt_id)
    {
        $sugerencia = Sugerencia::where('encrypt_id', $encrypt_id)->first();
        return view('contenido.sugerencias.read')->with('sugerencia', $sugerencia);
    }

    public function edit($encrypt_id)
    {
        $sugerencia = Sugerencia::where('encrypt_id', $encrypt_id)->first();
        $usuarios = User::select('encrypt_id', 'primer_nombre')->where('status', 1)->orderBy('primer_nombre')->get();
        $fecha = \Carbon\Carbon::parse($sugerencia->fecha)->format('Y-m-d');
        return view('contenido.sugerencias.edit')->with('sugerencia', $sugerencia)
            ->with('usuarios', $usuarios)
            ->with('fecha', $fecha);
    }

    public function update(Request $request, $encrypt_id)
    {
        $sugerencia = Sugerencia::where('encrypt_id', $encrypt_id)->first();
        $sugerencia->contenido = $request->contenido;
        $sugerencia->fecha = $request->fecha;
        $sugerencia->encrypt_id                       = encrypt($sugerencia->id);
        $user =  User::select('id')->where('encrypt_id', $request->id_usuario)->first();
        $sugerencia->id_usuario = $user->id;
        $sugerencia->status = $request->input('status');

        $sugerencia->update();
        return redirect('/sugerencias');
    }

    public function destroy($encrypt_id)
    {
        $sugerencia = Sugerencia::where('encrypt_id', $encrypt_id)->first();
        $sugerencia->status = 0;
        $sugerencia->save();
        return redirect('/sugerencias');
    }

    public function nuevaSugerencia()
    {
        return view('proyecto.contenido.operaciones.sugerencias');
    }

    public function enviarSugerencia(Request $request)
    {
        // Aquí puedes acceder a los datos del formulario a través del objeto $request
        $contenido = $request->input('sugerencia');
        $fecha = Carbon::now();
        $sugerencia = new Sugerencia;
        $sugerencia->contenido = $contenido;
        $sugerencia->fecha = $fecha;
        $sugerencia->encrypt_id                       = encrypt($sugerencia->id);
        $userId = Auth::user()->id;
        $sugerencia->id_usuario = $userId;
        $sugerencia->status = 1;
        $sugerencia->save();
        return view('proyecto.contenido.operaciones.sugerencia.enviada');

    }
}
