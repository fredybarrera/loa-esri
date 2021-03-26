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

class TicketController extends Controller
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
        $items = Ticket::orderBy('codigo')->get();

        return view('ticket.index', [
            'title' => 'Tickets',
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
            $proyectos = Proyecto::where('estado', Define::ESTADO_ACTIVO)->orderBy('nombre')->get();
            $estados = Define::getEstadosTexto();

            return view('ticket.crear', [
                'title' => 'Ticket',
                'usuarios' => $usuarios,
                'estados' => $estados,
                'proyectos' => $proyectos
            ]);
        }catch (\Exception $e){
            Custom::error('TicketController', 'create', $e);
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
            $validator = Ticket::valida($request);
            
            if ($validator->fails())
            {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            Ticket::crear($req);

            return redirect()->route('ticket.index')->with([
                'title'   => 'Exito',
                'message' => 'Ticket creado correctamente',
                'type'    => 'success'
            ]);
            
        }catch (\Exception $e){
            Custom::error('TicketController', 'store', $e);
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
            $item = Ticket::findOrFail($id);
            $usuarios = User::where('estado', Define::ESTADO_ACTIVO)->orderBy('nombres')->get();
            $proyectos = Proyecto::where('estado', Define::ESTADO_ACTIVO)->orderBy('nombre')->get();
            $estados = Define::getEstadosTexto();
            $tickets_user = [];

            foreach ($item->usuarios as $usuario) {
                $tickets_user[] = $usuario->codigo;
            }

            return view('ticket.editar', [
                'item' => $item,
                'title' => 'Ticket',
                'usuarios' => $usuarios,
                'proyectos' => $proyectos,
                'estados' => $estados,
                'tickets_user' => $tickets_user
            ]);
        }catch (\Exception $e){
            Custom::error('TicketController', 'edit', $e);
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
            $validator = Ticket::valida($request, $id);
            
            if ($validator->fails())
            {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            Ticket::editar($req, $id);

            return redirect()->back()->with([
                'title'   => 'Exito',
                'message' => 'Ticket editado correctamente',
                'type'    => 'success'
            ]);

        }catch (\Exception $e){
            Custom::error('TicketController', 'update', $e);
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

            Ticket::desactivarActivar($id);

            return response()->json([
                'status' => 'success'
            ]);

        }catch (\Exception $e){
            Custom::error('TicketController', 'destroy', $e);
        }
    }
}
