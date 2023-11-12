<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::where('status', 1)->orderBy('nombre')->get();
        return view('contenido.roles.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contenido.roles.create');
    }

    public function store(Request $request)
    {
        $role = new Role;
        $role->nombre = $request->nombre;
        $role->encrypt_id                       = encrypt($role->id);
        $role->status = $request->input('status');
        $role->save();
        return redirect('/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($encrypt_id)
    {
        $role = Role::where('encrypt_id', $encrypt_id)->first();
        return view('contenido.roles.read')->with('role', $role);
    }

    public function edit($encrypt_id)
    {
        $role = Role::where('encrypt_id', $encrypt_id)->first();
        return view('contenido.roles.edit')->with('role', $role);
    }

    public function update(Request $request, $encrypt_id)
    {
        $role = Role::where('encrypt_id', $encrypt_id)->first();
        $role->nombre = $request->nombre;
        $role->encrypt_id                       = encrypt($role->id);
        $role->status = $request->input('status');
        $role->update();
        return redirect('/roles');
    }

    public function destroy($encrypt_id)
    {
        $role = Role::where('encrypt_id', $encrypt_id)->first();
        $role->status = 0;
        $role->save();
        return redirect('/roles');
    }
}


