<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Notificacion;
use Illuminate\Support\Str;


class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentos = Documento::where('status', 1)->orderBy('nombre')->get();
        return view('contenido.documentos.index')->with('documentos', $documentos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = User::select('encrypt_id', 'primer_nombre')->where('status', 1)->orderBy('primer_nombre')->get();
        return view('contenido.documentos.create')
            ->with('usuarios', $usuarios);
    }

    public function store(Request $request)
    {

        try {
            // Validar el archivo recibido
            $request->validate([
                'archivo' => 'required|max:20480000',
            ]);

            // Guardar la notificación            
            $documento = new Documento;
            $documento->nombre  = $request->archivo->getClientOriginalName();
            $documento->fecha = $request->fecha;
            $documento->tipo_documento = $request->tipo_documento;
            $documento->archivo = file_get_contents($request->archivo);
            $user =  User::select('id')->where('encrypt_id', $request->id_usuario)->first();
            $documento->id_usuario = $user->id;
            $documento->status = $request->input('status');
            $documento->encrypt_id                       = encrypt($documento->id);

            $archivo = $request->file('archivo');
            $nombre_archivo = $request->tipo_documento . '_' . $request->fecha . '_' . $archivo->getClientOriginalName();
            $rl = Storage::disk('fotografias')->put($nombre_archivo, File::get($archivo));
            $rl = Storage::disk('fotospublic')->put($nombre_archivo, File::get($archivo));
            if ($rl) {
                $documento->nombre_archivo   = $nombre_archivo;
                $documento->save();

                return redirect('/documentos');
            } else {
                return 'ERROR AL INTENTAR GUARDAR LA FOTO <br/><br/> <a href ="../documentos">REGRESAR A CRUD</a>';
            }
        } catch (\Exception $e) {
            // Mostrar mensaje de error y redirigir al usuario
            $documentos = Documento::where('status', 1)->orderBy('nombre')->get();
            return view('contenido.documentos.index', compact('documentos', 'e'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show($encrypt_id)
    {
        $documento = Documento::where('encrypt_id', $encrypt_id)->first();
        return view('contenido.documentos.read')->with('documento', $documento);
    }

    public function edit($encrypt_id)
    {
        $documento = Documento::where('encrypt_id', $encrypt_id)->first();
        $usuarios = User::select('encrypt_id', 'primer_nombre')->where('status', 1)->orderBy('primer_nombre')->get();
        $fecha = \Carbon\Carbon::parse($documento->fecha)->format('Y-m-d');

        return view('contenido.documentos.edit')->with('documento', $documento)
            ->with('usuarios', $usuarios)->with('fecha', $fecha);
    }

    public function update(Request $request, $encrypt_id)
    {
        $request->validate([
            'archivo' => 'required|max:20480',
        ]);
        $documento = Documento::where('encrypt_id', $encrypt_id)->first();
        $documento->nombre  = $request->archivo->getClientOriginalName();
        $documento->fecha = $request->fecha;
        $documento->tipo_documento = $request->tipo_documento;
        $documento->archivo = file_get_contents($request->archivo);
        $user =  User::select('id')->where('encrypt_id', $request->id_usuario)->first();
        $documento->id_usuario = $user->id;
        $documento->status = $request->input('status');
        $documento->encrypt_id                       = encrypt($documento->id);

        try {
            $documento->archivo = file_get_contents($request->archivo);
            $archivo = $request->file('archivo');
            $nombre_archivo = $request->tipo_documento . '_' . $request->fecha . '_' . $archivo->getClientOriginalName();
            $rl = Storage::disk('fotografias')->put($nombre_archivo, File::get($archivo));
            $rl = Storage::disk('fotospublic')->put($nombre_archivo, File::get($archivo));
            if ($rl) {
                $documento->nombre_archivo   = $nombre_archivo;
                $documento->update();
                return redirect('/documentos');
            } else {
                return 'ERROR AL INTENTAR GUARDAR LA FOTO <br/><br/> <a href ="../documentos">REGRESAR A CRUD</a>';
            }
        } catch (\Exception $e) {
            // Capturamos la excepción y hacemos algo en caso de error
            $documentos = Documento::where('status', 1)->orderBy('nombre')->get();
            return view('contenido.documentos.index', compact('documentos', 'e'));
        }
        return redirect('/documentos');
    }

    public function destroy($encrypt_id)
    {
        $documento = Documento::where('encrypt_id', $encrypt_id)->first();
        $documento->status = 0;
        $documento->save();
        return redirect('/documentos');
    }

    public function descargar($encrypt_id)
    {
        $documento = Documento::where('encrypt_id', $encrypt_id)->first();
        if ($documento) {
            $archivo = $documento->archivo;
            $nombre = $documento->nombre;
            return response($archivo, 200)->header('Content-Type', 'application/octet-stream')->header('Content-Disposition', 'attachment; filename="' . $nombre . '"');
        } else {
            return redirect()->route('documentos.index')->with('error', 'No se pudo descargar el archivo');
        }
    }

    public function descargarArchivo($encrypt_id)
    {
        $documento = Documento::where('encrypt_id', $encrypt_id)->first();

        if ($documento) {
            $nombre_archivo = $documento->nombre_archivo;
            // Obtener el contenido del archivo desde el sistema de archivos
            $contenidoArchivo = Storage::disk('fotospublic')->get($nombre_archivo);

            return response($contenidoArchivo, 200)
                ->header('Content-Type', 'application/octet-stream')
                ->header('Content-Disposition', 'attachment; filename="' . $nombre_archivo . '"');
        } else {
            return redirect()->route('documentos.index')->with('error', 'No se pudo descargar el archivo');
        }
    }



    public function obtenerDescripcionDocumento($documento)
    {
        // Aquí puedes implementar la lógica para obtener la descripción del documento según su identificador

        // Ejemplo de implementación:
        if ($documento === 'curp') {
            $descripcion = 'La Clave Única de Registro de Población es un único de identidad de 18 caracteres utilizado para identificar oficialmente tanto a residentes como a ciudadanos mexicanos de todo el país.';
            return response()->json(['descripcion' => $descripcion]);
        } elseif ($documento === 'fotografia') {
            $descripcion = 'Son fotografias de identificación tamaño 2.5 x 3 cm utilizadas principalmente para trámites escolares y en la iniciativa privada para la creación de gafetes e identificación de personal.';
            return response()->json(['descripcion' => $descripcion]);
        } elseif ($documento === 'ine') {
            $descripcion = 'Es un documento oficial expedido por el Instituto Nacional Electoral que permite a los ciudadanos mexicanos mayores de edad participar en las elecciones locales y federales, además de ser el documento más aceptado como identificación oficial para todos los actos civiles, administrativos, mercantiles, laborales, judiciales y en general, para todos los actos en que, por ley, la persona deba identificarse.';
            return response()->json(['descripcion' => $descripcion]);
        } elseif ($documento === 'Talon de Pago') {
            $descripcion = 'La Clave Única de Registro de Población es un único de identidad de 18 caracteres utilizado para identificar oficialmente tanto a residentes como a ciudadanos mexicanos de todo el país.';
            return response()->json(['descripcion' => $descripcion]);
        }

        // Si no se encuentra una descripción válida, puedes retornar un mensaje de error o algo similar
        return response()->json(['error' => 'No se encontró descripción para el documento seleccionado']);
    }

    public function dudasDocsRet()
    {
        return view('proyecto.contenido.operaciones.dudasDocs');
    }

    public function enviarDocumentos(Request $request)
    {
        try {
            // Validar el archivo recibido
            $request->validate([
                'archivos' => 'required|array|min:1', // Verificar que se haya seleccionado al menos un archivo
                'archivos.*' => 'required|file',
                // Verificar que cada archivo sea válido
            ]);
            $firstFile = 1;
            $isOk = false;
            // Validar y guardar los archivos subidos en la base de datos
            $randomString = Str::random(10);
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
                    $workerID = Auth::user()->id_trabajador;
                    $documento->id_usuario = $userId;
                    $documento->status = 1;
                    $documento->encrypt_id                       = encrypt($documento->id);
                    $nombre_archivo = $workerID . '_' . $fecha . '_' . 'solicitud_de_renovacion_' .  $archivo->getClientOriginalName();
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
                    $notificacion->nombre = 'Renovación de credencial';
                    $notificacion->contenido = 'Se han enviado nuevos documentos para renovación de credencial del usuario.' . $workerID." Operación: ".$randomString;
                    // Supongamos que el id_usuario es el del administrador, ajusta según tu diseño
                    $notificacion->id_usuario = 2;  // o cualquier otro valor que identifique al administrador
                    $notificacion->fecha = now();  // Asegúrate de que tu columna 'fecha' pueda aceptar fechas en este formato
                    // Guardar la notificación
                    $notificacion->nombre_archivo = $workerID;
                    $notificacion->archivo = $firstFile;
                    $notificacion->status = 1;
                    $notificacion->encrypt_id = encrypt($notificacion->id);
                    $notificacion->save();
                    return view('proyecto.contenido.operaciones.documentos.exito_docs');
                }
            }
        } catch (\Exception $e) {
            dd("Entrando al catch", $e);
            // Mostrar mensaje de error y redirigir al usuario
            return view('proyecto.contenido.operaciones.enviarDocs')->with('e', $e);
        }
    }
}
