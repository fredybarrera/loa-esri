<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Custom;
use App\Perfil;
use App\User;
use App\Define;
use App\Ticket;
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
        try{
            $perfiles = Perfil::orderBy('nombre')->get();
            $tickets = Ticket::where('activo', 'S')->orderBy('descripcion')->get();
            $estados = [Define::ESTADO_ACTIVO => 'Activo', Define::ESTADO_INACTIVO => 'Inactivo'];

            return view('usuario.crear', [
                'title' => 'Usuarios',
                'perfiles' => $perfiles,
                'tickets' => $tickets,
                'estados' => $estados
            ]);
        }catch (\Exception $e){
            Custom::error('UsuarioController', 'create', $e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $req = $request->all();
            $validator = User::validaGuardar($request);
            
            if ($validator->fails())
            {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $id = User::crearUsuario($req);

            return redirect()->back()->with([
                'title'   => 'Exito',
                'message' => 'Usuario creado correctamente',
                'type'    => 'success'
            ]);
            
        }catch (\Exception $e){
            Custom::error('UsuarioController', 'store', $e);
        }
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
        try{
            $item = User::findOrFail($id);
            $perfiles = Perfil::orderBy('nombre')->get();
            $tickets = Ticket::where('activo', 'S')->orderBy('descripcion')->get();
            $estados = [Define::ESTADO_ACTIVO => 'Activo', Define::ESTADO_INACTIVO => 'Inactivo'];
            $user_perfiles  = [];
            $user_tickets  = [];

            foreach ($item->perfiles as $perfil) {
                $user_perfiles[] = $perfil->id;
            }

            foreach ($item->tickets as $ticket) {
                $user_tickets[] = $ticket->codigo;
            }

            return view('usuario.editar', [
                'title' => 'Usuarios',
                'item' => $item,
                'perfiles' => $perfiles,
                'estados' => $estados,
                'tickets' => $tickets,
                'user_perfiles' => $user_perfiles,
                'user_tickets' => $user_tickets
            ]);
        }catch (\Exception $e){
            Custom::error('UsuarioController', 'edit', $e);
        }
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
        try{
            $req = $request->all();
            $validator = User::validaEditar($request, $id);
            
            if ($validator->fails())
            {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            User::editarUsuario($req, $id);

            return redirect()->back()->with([
                'title'   => 'Exito',
                'message' => 'Usuario editado correctamente',
                'type'    => 'success'
            ]);

            // return redirect()->route('usuario.index')->with([
            //     'title'   => 'Exito',
            //     'message' => 'Usuario editado correctamente',
            //     'type'    => 'success'
            // ]);
            
        }catch (\Exception $e){
            Custom::error('UsuarioController', 'update', $e);
        }
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
