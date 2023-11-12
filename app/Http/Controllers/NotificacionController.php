<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Documento;  // Asegúrate de incluir el modelo Documento
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;



class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notificaciones = Notificacion::where('status', 1)->orderBy('nombre')->get();
        return view('contenido.notificaciones.index')->with('notificaciones', $notificaciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = User::select('encrypt_id', 'primer_nombre')->where('status', 1)->orderBy('primer_nombre')->get();
        return view('contenido.notificaciones.create')
            ->with('usuarios', $usuarios);
    }

    public function store(Request $request)
    {
        try {
            // Validar el archivo recibido
            $request->validate([
                'archivo' => 'required|max:20480',
            ]);

            // Guardar la notificación
            $notificacion = new Notificacion;
            $notificacion->nombre = $request->nombre;
            $notificacion->fecha = $request->fecha;
            $notificacion->contenido = $request->contenido;
            $notificacion->nombre_archivo = $request->archivo->getClientOriginalName();
            $notificacion->archivo = file_get_contents($request->archivo);
            $user =  User::select('id')->where('encrypt_id', $request->id_usuario)->first();
            $notificacion->id_usuario = $user->id;
            $notificacion->status = $request->input('status');
            $notificacion->encrypt_id = encrypt($notificacion->id);
            $notificacion->save();

            return redirect('/notificaciones');
        } catch (\Exception $e) {
            // Mostrar mensaje de error y redirigir al usuario
            $notificaciones = Notificacion::where('status', 1)->orderBy('nombre')->get();
            return view('contenido.notificaciones.index')->with('notificaciones', $notificaciones)->with('e', $e);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\notificacion  $notificacion
     * @return \Illuminate\Http\Response
     */
    public function show($encrypt_id)
    {
        $notificacion = Notificacion::where('encrypt_id', $encrypt_id)->first();

        if ($notificacion && $notificacion->nombre == 'Renovación de credencial') {
            // Obtiene los documentos relacionados con la notificación
            $documentos = Documento::where('nombre_archivo', 'like', 'solicitud de renovacion%')
                ->where('id_usuario', $notificacion->id_trabajador)  // asumiendo que id_usuario en Documento es el mismo que id_trabajador en Notificacion
                ->whereDate('fecha', $notificacion->fecha)
                ->get();
        } else {
            $documentos = collect();  // devuelve una colección vacía si no hay documentos asociados
        }
        // Envía los datos a la vista
        return view('contenido.notificaciones.read')->with([
            'notificacion' => $notificacion,
            'documentos' => $documentos
        ]);
    }

    public function edit($encrypt_id)
    {
        $notificacion = Notificacion::where('encrypt_id', $encrypt_id)->first();
        $usuarios = User::select('encrypt_id', 'primer_nombre')->where('status', 1)->orderBy('primer_nombre')->get();
        $fecha = \Carbon\Carbon::parse($notificacion->fecha)->format('Y-m-d');
        return view('contenido.notificaciones.edit')
            ->with('notificacion', $notificacion)
            ->with('usuarios', $usuarios)
            ->with('fecha', $fecha);
    }

    public function update(Request $request, $encrypt_id)
    {

        try {
            $request->validate([
                'archivo' => 'required|max:20480',
            ]);

            $notificacion = Notificacion::where('encrypt_id', $encrypt_id)->first();
            $notificacion->nombre = $request->nombre;
            $notificacion->fecha = $request->fecha;
            $notificacion->contenido = $request->contenido;
            $notificacion->nombre_archivo = $request->archivo->getClientOriginalName();
            $notificacion->encrypt_id = encrypt($notificacion->id);
            $user = User::select('id')->where('encrypt_id', $request->id_usuario)->first();
            $notificacion->id_usuario = $user->id;
            $notificacion->status = $request->input('status');
            $notificacion->archivo = file_get_contents($request->archivo);
        } catch (Exception $e) {
            // Capturamos la excepción y hacemos algo en caso de error
            $notificaciones = Notificacion::where('status', 1)->orderBy('nombre')->get();
            return view('contenido.notificaciones.index')->with('notificaciones', $notificaciones)->with('e', $e);
        }

        $notificacion->update();
        return redirect('/notificaciones');
    }


    public function destroy($encrypt_id)
    {
        $notificacion = Notificacion::where('encrypt_id', $encrypt_id)->first();
        $notificacion->status = 0;
        $notificacion->save();
        return redirect('/notificaciones');
    }
    public function descargar($encrypt_id)
    {
        $notificacion = Notificacion::where('encrypt_id', $encrypt_id)->first();
        if ($notificacion) {
            $archivo = $notificacion->archivo;
            $nombre_archivo = $notificacion->nombre_archivo;
            return response($archivo, 200)->header('Content-Type', 'application/octet-stream')->header('Content-Disposition', 'attachment; filename="' . $nombre_archivo . '"');
        } else {
            return redirect()->route('notificaciones.index')->with('error', 'No se pudo descargar el archivo');
        }
    }

    public function notificacionesUsuario()
    {
        if (Auth::check()) {
            // Obtener el ID del usuario logueado
            $userId = Auth::user()->id;

            // Hacer algo con el objeto del usuario logueado
            // ...
            $notificaciones = Notificacion::where('id_usuario', $userId)
                ->orderBy('fecha', 'desc')
                ->get();
            return view('proyecto.contenido.operaciones.buzon')->with('notificaciones', $notificaciones);
        }
    }


    public function responderNotificacion($eid_notificacion, $eidtrabajador)
    {
        return view('proyecto.contenido.operaciones.buzon.responder')->with([
            'notificacionRetorno' => $eid_notificacion,
            'eidtrabajador' => $eidtrabajador,
        ]);
    }

    public function enviarNotificacionRespuesta()
    {
    }

    public function detalleNotificacion($notificacion)
    {
        $notificacionRetorno = Notificacion::where('encrypt_id', $notificacion)->first();

        $fechaFormateada = \Carbon\Carbon::parse($notificacionRetorno->fecha)->format('d-m-y');
        $formatToFind = $notificacionRetorno->nombre_archivo . '_' . $fechaFormateada . '_solicitud_de_renovacion%';
        $trabajador_id = null;
        // Obtiene los documentos relacionados con la notificación
        $ultimos10Caracteres = substr($notificacionRetorno->contenido, -10);
        $documentos = Documento::where('tipo_documento', $ultimos10Caracteres)->get();

        if (!$documentos->isEmpty()) {
            $documentoFind = Documento::where('tipo_documento', $ultimos10Caracteres)->first();
            $trabajador_id = User::where('id',  $documentoFind->id_usuario)->first();
            $trabajador_id = $trabajador_id->encrypt_id;
        } else {
            $documentos = collect();  // devuelve una colección vacía si no hay documentos asociados
        }
        // Envía los datos a la vista
        return view('proyecto.contenido.operaciones.buzon.detalle_notificacion')->with([
            'notificacionRetorno' => $notificacionRetorno,
            'documentos' => $documentos,
            'trabajador_id' => $trabajador_id
        ]);
    }


    public function enviarRespuesta(
        Request $request,
        $encrypt_id,
        $eid_trabajador
    ) {
        try {
            $request->validate([
                'archivos' => 'array|min:1', // Verificar que se haya seleccionado al menos un archivo
                'archivos.*' => 'file',
                // Verificar que cada archivo sea válido
            ]);

            $titulo = $request->input('titulo');
            $contenido = $request->input('contenido');
            // $notificacion = new Notificacion;
            // $notificacion->nombre = $titulo;
            // $notificacion->fecha = Carbon::now();
            // $notificacion->contenido = $contenido;
            // $notificacion->nombre_archivo = $request->archivo->getClientOriginalName();
            $usuario = User::where('encrypt_id', $eid_trabajador)->first();
            $trabajador_id = $usuario->id_trabajador;

            $firstFile = 1;
            $randomString = Str::random(10);
            $isOk = false;

            if ($request->hasFile('archivos')) {
                foreach ($request->file('archivos') as $archivo) {
                    $firstFile = $archivo;
                    $fecha = Carbon::now()->format('d-m-y');
                    // Guardar la notificación            
                    $documento = new Documento;
                    $documento->nombre  = $archivo->getClientOriginalName();
                    $documento->fecha = $fecha;
                    $documento->tipo_documento = $randomString;
                    $userId = Auth::user()->id;
                    $trabajador_id = Auth::user()->id_trabajador;
                    $documento->id_usuario = $userId;
                    $documento->status = 1;
                    $documento->encrypt_id                       = encrypt($documento->id);
                    $nombre_archivo = $trabajador_id . '_' . $fecha . '_' . 'respuesta_de_renovacion_' .  $archivo->getClientOriginalName();
                    $rl = Storage::disk('fotografias')->put($nombre_archivo, File::get($archivo));
                    $rl = Storage::disk('fotospublic')->put($nombre_archivo, File::get($archivo));
                    if ($rl) {
                        $documento->nombre_archivo   = $nombre_archivo;
                        $contenidoArchivo = Storage::disk('fotospublic')->get($nombre_archivo);
                        // Asignar el contenido al campo 'archivo' del modelo
                        $documento->archivo = "operacion1";
                        $documento->save();
                        $isOk = true;
                    } else {
                        return 'ERROR AL INTENTAR GUARDAR LA FOTO <br/><br/> <a href ="../documentos">REGRESAR A CRUD</a>';
                    }
                }
                if ($isOk) {
                    // Crear una nueva notificación -----------
                    $notificacion = new Notificacion;

                    $notificacion->nombre = $titulo;
                    $notificacion->contenido = $contenido . "Operación: " . $randomString;

                    // Supongamos que el id_usuario es el del administrador, ajusta según tu diseño


                    $notificacion->id_usuario = $usuario->id;  // o cualquier otro valor que identifique al administrador
                    $notificacion->fecha = now();  // Asegúrate de que tu columna 'fecha' pueda aceptar fechas en este formato
                    // Guardar la notificación
                    $notificacion->nombre_archivo = $trabajador_id;
                    $notificacion->archivo = $firstFile;
                    $notificacion->status = 1;
                    $notificacion->encrypt_id = encrypt($notificacion->id);
                    $notificacion->save();
                }
            } else {
                // Crear una nueva notificación -----------
                $notificacion = new Notificacion;

                $notificacion->nombre = $titulo;
                $notificacion->contenido = $contenido . "Operación: " . $randomString;

                // Supongamos que el id_usuario es el del administrador, ajusta según tu diseño


                $notificacion->id_usuario = $usuario->id;  // o cualquier otro valor que identifique al administrador
                $notificacion->fecha = now();  // Asegúrate de que tu columna 'fecha' pueda aceptar fechas en este formato
                // Guardar la notificación
                $notificacion->nombre_archivo = $trabajador_id;
                $notificacion->archivo = '123';
                $notificacion->status = 1;
                $notificacion->encrypt_id = encrypt($notificacion->id);
                $notificacion->save();
            }
            return view('proyecto.contenido.operaciones.buzon.enviada');
        } catch (\Exception $e) {
            dd("Entrando al catch", $e);
            // Mostrar mensaje de error y redirigir al usuario
            return view('proyecto.contenido.operaciones.buzon.responder')->with([
                'notificacionRetorno' => $encrypt_id,
                'trabajador_id' => $trabajador_id,
            ]);
        }
    }
}
