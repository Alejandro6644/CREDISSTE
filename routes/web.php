<?php

use App\Http\Controllers\CorreoController;
use App\Http\Controllers\DetallePagoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SugerenciaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Notificacion;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('proyecto.contenido.login');
})->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('loginAuth');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::middleware(['auth'])->group(function () {

    Route::get('/error-login', function () {
        return view('proyecto.contenido.operaciones.errorLogin.error_login');
    });

    Route::get('/home', function () {
        // Esta ruta solo puede ser accedida por usuarios autenticados
        return view('proyecto.contenido.operaciones.enviarDocs');
    });

    //RUTAS ADMIN 

    Route::middleware(['role:Administrador'])->group(function () {
        Route::get('/generar_pdf/{encabezado}/{opcion}', [PDFController::class, 'generarPDF'])->name('generar_pdf');
        Route::post('/guardar-grafica/{encabezado}/{opcion}', [PDFController::class, 'guardarGrafica']);
        Route::resource('/users', UserController::class);
        Route::resource('/roles', RoleController::class);
        Route::resource('/sugerencias', SugerenciaController::class);
        Route::resource('/paises', PaisController::class);
        Route::resource('/pagos', PagoController::class);
        Route::resource('/notificaciones', NotificacionController::class);
        Route::resource('/municipios', MunicipioController::class);
        Route::resource('/instituciones', InstitucionController::class);
        Route::resource('/estados', EstadoController::class);
        Route::resource('/documentos', DocumentoController::class);
        Route::resource('/detallePagos', DetallePagoController::class);
        Route::resource('/correos', CorreoController::class);
        // el primer id es de la notificación, el segundo del trabajador al que se responde
        Route::get('/responder/{encrypt_id}/{trabajador_id}',[NotificacionController::class, 'responderNotificacion'])->name('notificaciones.responder.pdf');
        Route::post('/enviar/{encrypt_id}/{eid_trabajador}',[NotificacionController::class, 'enviarRespuesta'])->name('notificaciones.enviar.respuesta');
    });


    //RUTAS User

    Route::middleware(['role:Usuario'])->group(function () {
        Route::get('/home/operaciones/nomina', [DetallePagoController::class, 'verNomina'])->name('nominas');
        Route::get('/actualizar-grafica/{opcion}', [DetallePagoController::class, 'actualizarGrafica'])->name('actualizar.grafica');
        Route::resource('/users', UserController::class)->except(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
        Route::resource('/roles', RoleController::class)->except(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
        Route::resource('/sugerencias', SugerenciaController::class)->except(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
        Route::resource('/paises', PaisController::class)->except(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
        Route::resource('/pagos', PagoController::class)->except(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
        Route::resource('/notificaciones', NotificacionController::class)->except(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
        Route::resource('/municipios', MunicipioController::class)->except(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
        Route::resource('/instituciones', InstitucionController::class)->except(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
        Route::resource('/estados', EstadoController::class)->except(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
        Route::resource('/documentos', DocumentoController::class)->except(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
        Route::resource('/detallePagos', DetallePagoController::class)->except(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
        Route::resource('/correos', CorreoController::class)->except(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
    });
    
    //RUTAS Moderador

    Route::middleware(['role:Moderador'])->group(function () {
        Route::get('/home/operaciones/nomina', [DetallePagoController::class, 'verNomina'])->name('nominas');
        Route::get('/actualizar-grafica/{opcion}', [DetallePagoController::class, 'actualizarGrafica'])->name('actualizar.grafica');
        Route::resource('/users', UserController::class)->only(['index']);
        Route::resource('/roles', RoleController::class)->only(['index']);
        Route::resource('/sugerencias', SugerenciaController::class)->only(['index']);
        Route::resource('/paises', PaisController::class)->only(['index']);
        Route::resource('/pagos', PagoController::class)->only(['index']);
        Route::resource('/notificaciones', NotificacionController::class)->only(['index']);
        Route::resource('/municipios', MunicipioController::class)->only(['index']);
        Route::resource('/instituciones', InstitucionController::class)->only(['index']);
        Route::resource('/estados', EstadoController::class)->only(['index']);
        Route::resource('/documentos', DocumentoController::class)->only(['index']);
        Route::resource('/detallePagos', DetallePagoController::class)->only(['index']);
        Route::resource('/correos', CorreoController::class)->only(['index']);
    });



    //PROYECTO

    Route::get('/home/operaciones/enviar-documentos', function () {
        return view('proyecto.contenido.operaciones.enviarDocs');
    })->name('enviarDocs');


    //CORREO
    Route::get('/correo', function () {
        return view('contenido.email.email');
    });

    // CRUD
    Route::get('/crud', function () {
        return view('contenido.crud');
    });
    Route::post('/enviar-sugerencias', [SugerenciaController::class, 'enviarSugerencia'])->name('enviarSugerencias');
    Route::post('/enviar-documentos', [DocumentoController::class, 'enviarDocumentos'])->name('enviarDocumentos');
    Route::get('/home/operaciones/sugerencia', [SugerenciaController::class, 'nuevaSugerencia'])->name('sugerencia');
    Route::get('/home/operaciones/buzon', [NotificacionController::class, 'notificacionesUsuario'])->name('buzon');
    Route::get('/home/operaciones/dudas-documentos', [DocumentoController::class, 'dudasDocsRet'])->name('dudasDocs');
    Route::get('/detalle-notificacion/{notificacion}', [NotificacionController::class, 'detalleNotificacion'])->name('detalleNotificacion');



    // AJAX
    Route::get('/obtener-descripcion-documento/{documento}', [DocumentoController::class, 'obtenerDescripcionDocumento'])->name('obtener.descripcion.documento');
    Route::get('combo_entidad_pais/{id_pais}', [EstadoController::class, 'cambia_combo_entidad']);
    Route::get('combo_entidad_pais/{id_pais}', [EstadoController::class, 'cambia_combo_entidad']);
    Route::get('combo_muni_entidad/{id_estado}', [EstadoController::class, 'cambia_combo_municipio']);
    Route::get('combo_entidad_institucion/{id_estado}', [EstadoController::class, 'cambia_combo_institucion']);
    Route::get('notificaciones/{encrypt_id}/descargar', [NotificacionController::class, 'descargar'])->name('notificaciones.descargar');
    Route::get('documentos/{encrypt_id}/descargar', [DocumentoController::class, 'descargar'])->name('documentos.descargar');
    Route::get('documentos/descargar-archivo/{encrypt_id}', [DocumentoController::class, 'descargarArchivo'])->name('documentos.descargar.archivo');

});


Route::get('validar_trabajador/{id_pais}', [UserController::class, 'validar_trabajador']);
Route::post('send_email', [CorreoController::class, 'enviar_correo'])->name('enviar.correo');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
