<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Institucion;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Pais;

class UserController extends Controller
{

    public function index()
    {
        $usuarios = User::where('status', 1)->orderBy('primer_nombre')->get();

        return view('contenido.usuarios.index')->with('usuarios', $usuarios);
    }

    public function create()
    {
        $paises = Pais::select('encrypt_id', 'nombre')->where('status', 1)->orderBy('nombre')->get();
        $estados = Estado::select('encrypt_id', 'nombre')->where('status', 1)->orderBy('nombre')->get();
        $municipios = Municipio::select('encrypt_id', 'nombre')->where('status', 1)->orderBy('nombre')->get();
        $instituciones = Institucion::select('encrypt_id', 'nombre')->where('status', 1)->orderBy('nombre')->get();
        $roles = Role::select('encrypt_id', 'nombre')->where('status', 1)->orderBy('nombre')->get();
        return view('contenido.usuarios.create')
            ->with('paises', $paises)
            ->with('municipios', $municipios)
            ->with('estados', $estados)
            ->with('instituciones', $instituciones)
            ->with('roles', $roles);
    }


    public function show($encrypt_id)
    {
        $usuario = User::where('encrypt_id', $encrypt_id)->first();
        return view('contenido.usuarios.read')->with('usuario', $usuario);
    }

    public function store(Request $request)
    {

        try{
            $request->validate([
                'id_trabajador' => 'required|unique:pagos,identificador,' 
            ]);
            var_dump($request->all());
            $user = new User;
            $user->primer_nombre = $request->primer_nombre;
            $user->segundo_nombre = $request->segundo_nombre;
            $user->primer_apellido = $request->primer_apellido;
            $user->segundo_apellido = $request->segundo_apellido;
            $user->id_trabajador = $request->id_trabajador;  
            $municipio =  Municipio::select('id')->where('encrypt_id', $request->id_municipio)->first();
            $institucion =  Institucion::select('id')->where('encrypt_id', $request->id_institucion)->first();
            $role =  Role::select('id')->where('encrypt_id', $request->id_role)->first();
            $user->password = bcrypt($request->password);
            $user->id_municipio = $municipio->id;
            $user->id_institucion = $institucion->id;
            $user->id_role = $role->id;
            $user->status = $request->input('status');
            $user->encrypt_id                       = encrypt($user->id);
            $user->save();
            return redirect('/users');
        } catch(\Exception $e){
            $e = 'CLAVE DEBE SER ÚNICA';
            return redirect()->back()->withErrors($e);
        }
    }



    public function edit($encrypt_id)
    {

        $user = User::where('encrypt_id', $encrypt_id)->first();
        $paises = Pais::select('encrypt_id', 'nombre')->where('status', 1)->orderBy('nombre')->get();
        $estados = Estado::select('encrypt_id', 'nombre')->where('status', 1)->orderBy('nombre')->get();
        $municipios = Municipio::select('encrypt_id', 'nombre')->where('status', 1)->orderBy('nombre')->get();
        $instituciones = Institucion::select('encrypt_id', 'nombre')->where('status', 1)->orderBy('nombre')->get();
        $roles = Role::select('encrypt_id', 'nombre')->where('status', 1)->orderBy('nombre')->get();
        return view('contenido.usuarios.edit')
            ->with('paises', $paises)
            ->with('municipios', $municipios)
            ->with('estados', $estados)
            ->with('instituciones', $instituciones)
            ->with('roles', $roles)
            ->with('user', $user);
    }

    public function update(Request $request, $encrypt_id)
    {
        try{
            $user = User::where('encrypt_id', $encrypt_id)->first();
            $request->validate([
                'id_trabajador' => 'required|unique:usuarios,id_trabajador,' . $user->id
            ]);
            $user->primer_nombre = $request->primer_nombre;
            $user->segundo_nombre = $request->segundo_nombre;
            $user->primer_apellido = $request->primer_apellido;
            $user->segundo_apellido = $request->segundo_apellido;
            $user->id_trabajador = $request->id_trabajador;  
            $municipio =  Municipio::select('id')->where('encrypt_id', $request->id_municipio)->first();
            $institucion =  Institucion::select('id')->where('encrypt_id', $request->id_institucion)->first();
            $role =  Role::select('id')->where('encrypt_id', $request->id_role)->first();
            $user->password = bcrypt($request->password);
            $user->id_municipio = $municipio->id;
            $user->id_institucion = $institucion->id;
            $user->id_role = $role->id;
            $user->status = $request->input('status');
            $user->update();
            return redirect('/users');
        } catch(\Exception $e){
            $e = 'CLAVE DEBE SER ÚNICA';
            return redirect()->back()->withErrors($e);
        }
    }

    public function destroy($encrypt_id)
    {
        $user = User::where('encrypt_id', $encrypt_id)->first();
        $user->status = 0;
        $user->save();
        return redirect('/users');
    }

    public function validar_trabajador($id_trabajador)
    {
        $trabajador = User::where('id_trabajador', $id_trabajador)->first();
        if ($trabajador) {
            return response()->json(['existe' => true]);
        } else {
            return response()->json(['existe' => false]);
        }
    }
}
