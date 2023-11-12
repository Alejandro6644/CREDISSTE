<?php

namespace App\Http\Controllers;

use App\Models\Correo;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CorreoController extends Controller
{
    public function enviar_correo(Request $request)
    {

        $correo = new Correo;
        $correo->origen = 'agonzalezr8@toluca.tecnm.mx';
        $correo->destinatario = $request->input("destinatario");
        $correo->contenido = $request->input("contenido");
        $correo->encrypt_id                       = encrypt($correo->id);
        $correo->save();


        $destinatario = $request->input("destinatario");
        $asunto = $request->input("asunto");
        $contenido = $request->input("contenido");

        $data = array('contenido' => $contenido);
        $r = Mail::send(
            'contenido.email.plantilla_correo',
            $data,
            function ($message) use ($asunto, $destinatario) {
                $message->from('agonzalezr8@toluca.tecnm.mx', 'ALEJANDRO GONZALEZ XD');
                $message->to($destinatario)->subject($asunto);
            }
        );
        if (!$r) {
            return view('contenido.email.plantillamensaje')
                ->with('var', '2')
                ->with('msj', 'Error al enviar el correo')
                ->with('ruta_boton', '/crud')
                ->with('mensaje_boton', 'Home');
        } else {
            return view('contenido.email.plantillamensaje')
                ->with('var', '1')
                ->with('msj', 'Success al enviar el correo')
                ->with('ruta_boton', '/crud')
                ->with('mensaje_boton', 'Home');
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $correos = Correo::where('status', 1)->get();
        return view('contenido.correos.index')->with('correos', $correos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contenido.correos.create');
    }

    public function store(Request $request)
    {
        $correo = new Correo;
        $correo->origen = $request->origen;
        $correo->destinatario = $request->destinatario;
        $correo->fecha = $request->fecha;
        $correo->contenido = $request->contenido;
        $correo->encrypt_id                       = encrypt($correo->id);
        $correo->status = $request->input('status');
        $correo->save();
        return redirect('/correos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function show($encrypt_id)
    {
        $correo = Correo::where('encrypt_id', $encrypt_id)->first();
        return view('contenido.correos.read')
        ->with('correo', $correo);
    }

    public function edit($encrypt_id)
    {
        $correo = Correo::where('encrypt_id', $encrypt_id)->first();
        $fecha = \Carbon\Carbon::parse($correo->fecha)->format('Y-m-d');
        return view('contenido.correos.edit')
        ->with('correo', $correo)
        ->with('fecha', $fecha);
    }

    public function update(Request $request, $encrypt_id)
    {
        $correo = Correo::where('encrypt_id', $encrypt_id)->first();
        $correo->origen = $request->origen;
        $correo->destinatario = $request->destinatario;
        $correo->fecha = $request->fecha;
        $correo->contenido = $request->contenido;
        $correo->encrypt_id                       = encrypt($correo->id);
        $correo->status = $request->input('status');
        $correo->update();
        return redirect('/correos');
    }

    public function destroy($encrypt_id)
    {
        $correo = Correo::where('encrypt_id', $encrypt_id)->first();
        $correo->status = 0;
        $correo->save();
        return redirect('/correos');
    }
}
