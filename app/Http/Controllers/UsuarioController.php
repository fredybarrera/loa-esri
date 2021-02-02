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


    /**
     * Update passwords users
     *
     * @param  int  $key
     * @return \Illuminate\Http\Response
     */
    public function resetPassword($key)
    {
        if (md5($key) == '0a162e7fc31bf67ed4df116a86a2dcc7') //fbarrera
        {
            DB::table('usuario')
            ->where('password', null)
            ->update(array('password' => bcrypt('123')));
            
            die('Contraseñas actualizadas');

        }else{
            die('Key inválida');
        }
    }


    public function updateUserProfile($key)
    {
        if (md5($key) == '0a162e7fc31bf67ed4df116a86a2dcc7') //fbarrera
        {

            DB::table('usuario_perfil')->whereNotNull('id')->delete();

            // Usuarios administradores
            $usuarios = DB::table('usuario')->whereIn('perfil', ['ADMIN', 'ADMIN,COMUN'])->get();

            if (sizeof($usuarios) > 0)
            {
                foreach($usuarios as $usuario)
                {
                    DB::table('usuario_perfil')->insert([
                        'perfil_id' => 1,
                        'usuario_id' => $usuario->id,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
                }
            }

            // Usuarios comunes
            $usuarios_a = DB::table('usuario')->where('perfil', 'COMUN')->get();
            $usuarios_b = DB::table('usuario')->whereNull('perfil')->get();

            if (sizeof($usuarios_a) > 0)
            {
                foreach($usuarios_a as $usuario)
                {
                    DB::table('usuario_perfil')->insert([
                        'perfil_id' => 2,
                        'usuario_id' => $usuario->id,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
                }
            }

            if (sizeof($usuarios_b) > 0)
            {
                foreach($usuarios_b as $usuario)
                {
                    DB::table('usuario_perfil')->insert([
                        'perfil_id' => 2,
                        'usuario_id' => $usuario->id,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
                }
            }
            
            die('Usuarios actualizados actualizadas');
            

        }else{
            die('Key inválida');
        }
    }

}
