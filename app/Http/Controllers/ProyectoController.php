<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Custom;
use App\Perfil;
use App\User;
use App\Define;
use App\Ticket;
use App\Proyecto;
use Auth;

class ProyectoController extends Controller
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
        $items = Proyecto::orderBy('nombre')->get();

        return view('proyecto.index', [
            'title' => 'Proyectos',
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
            $usuarios = User::where('estado', Define::ESTADO_ACTIVO)->orderBy('nombres')->get();
            $estados = Define::getEstados();

            return view('proyecto.crear', [
                'title' => 'Proyectos',
                'usuarios' => $usuarios,
                'estados' => $estados
            ]);
        }catch (\Exception $e){
            Custom::error('ProyectoController', 'create', $e);
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
            $validator = Proyecto::valida($request);
            
            if ($validator->fails())
            {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            Proyecto::crear($req);

            return redirect()->route('proyecto.index')->with([
                'title'   => 'Exito',
                'message' => 'Proyecto editado correctamente',
                'type'    => 'success'
            ]);
            
        }catch (\Exception $e){
            Custom::error('ProyectoController', 'store', $e);
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
            $item = Proyecto::findOrFail($id);
            $usuarios = User::where('estado', Define::ESTADO_ACTIVO)->orderBy('nombres')->get();
            $estados = Define::getEstados();

            return view('proyecto.editar', [
                'item' => $item,
                'title' => 'Proyecto',
                'estados' => $estados,
                'usuarios' => $usuarios
            ]);
        }catch (\Exception $e){
            Custom::error('ProyectoController', 'edit', $e);
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
            $validator = proyecto::valida($request, $id);
            
            if ($validator->fails())
            {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            Proyecto::editar($req, $id);

            return redirect()->back()->with([
                'title'   => 'Exito',
                'message' => 'Proyecto editado correctamente',
                'type'    => 'success'
            ]);

        }catch (\Exception $e){
            Custom::error('ProyectoController', 'update', $e);
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

            Proyecto::desactivarActivar($id);

            return response()->json([
                'status' => 'success'
            ]);

        }catch (\Exception $e){
            Custom::error('ProyectoController', 'destroy', $e);
        }
    }
}
