<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Custom;
use App\Perfil;
use App\User;
use Auth;

class UsuarioController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Solo los usuarios autenticados y administradores pueden acceder a este recurso.
        $this->middleware('auth');
        $this->middleware('administradores');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::orderBy('apellidos')->get();

        return view('usuario.index', [
            'title' => 'Usuarios',
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = User::findOrFail($id);
        $perfiles = Perfil::orderBy('nombre')->get();

        return view('usuario.editar', [
            'title' => 'Usuarios',
            'item' => $item,
            'perfiles' => $perfiles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            User::desactivar($id);

            return response()->json([
                'status' => 'success'
            ]);

        }catch (\Exception $e){
            Custom::error('UsuarioController', 'destroy', $e);
        }
    }


    /**
     * Activa un usuario
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function activarUsuario(Request $request)
    {
        try{

            $input = $request->all();
            $id = $request->input('id');

            User::activar($id);

            return response()->json([
                'status' => 'success'
            ]);

        }catch (\Exception $e){
            Custom::error('TareaController', 'registrarTarea', $e);
        }
    }

}
