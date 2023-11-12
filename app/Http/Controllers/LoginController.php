<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        return view('proyecto.contenido.operaciones.enviarDocs');
    }





    public function login(Request $request)
    {
        $mensajes = [
            'id_trabajador.required' => 'El campo ID de trabajador es obligatorio.',
            'id_trabajador.exists' => 'El ID de trabajador no existe en nuestra base de datos.',
            'password.required' => 'El campo contraseña es obligatorio.',
        ];

        $credentials = $request->validate([
            'id_trabajador' => ['required', 'string', Rule::exists('usuarios', 'id_trabajador')],
            'password' => ['required', 'string'],
        ], $mensajes);



        $remeber = $request->filled('remember');
        if (Auth::attempt($credentials, $remeber)) {
            request()->session()->regenerate();
            $accessToken                    = auth()->user()->createToken('authToken')->accessToken;
            $user                           = auth()->user();
            return redirect('/home')->with('status', 'Estás logueado');
        }

        throw ValidationException::withMessages([
            'id_trabajador' => __('auth.failed')
        ]);
        // return responseGeneral(0, "El usuario o contraseña es invalido ", 401, "Sin datos por mostrar");
        //Como segundo parametro un boolean para mantener la sesion 
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            return redirect('/login');
        } catch (Exception $e) {
            //return responseGeneral(0, "Error al cerrar la sesión", 400, $e->getMessage());            
            var_dump('xd');
        }
    }

    public function redirectTo()
    {
        return route('/');
    }


}
