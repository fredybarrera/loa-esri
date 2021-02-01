<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Custom;
use App\Tarea;
use App\User;
use App\Ticket;
use Auth;
use DB;
use DateTime;

class TareaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            $usuario = User::find(Auth::user()->id);
            $tareas = Tarea::where('cod_usuario', $usuario->codigo)->orderBy('fecha')->get();
            $tickets = Ticket::select('ticket.descripcion', 'ticket.codigo')
                        ->join('usuario_ticket', 'usuario_ticket.cod_ticket', '=', 'ticket.codigo')
                        ->where('usuario_ticket.cod_usuario', $usuario->codigo)
                        ->orderBy('ticket.descripcion')
                        ->get();
            
            $eventList = [];
            foreach($tareas as $tarea)
            {
                $data['iniciativa'] = $tarea->ticket->descripcion;
                $data['observaciones'] = $tarea->observaciones;
                $data['cod_ticket'] = $tarea->ticket->codigo;
                $data['id'] = $tarea->codigo;
                $data['start'] = $tarea->fecha_inicio;
                $data['end'] = $tarea->fecha_fin;
                $eventList[] = $data;
            }

            return view('tarea.index', [
                'tareas' => $tareas,
                'eventList' => $eventList,
                'tickets' => $tickets,
                'title' => 'Tareas'
            ]);
        
        }catch (\Exception $e){
            Custom::error('TareaController', 'index', $e);
        } 
    }


    /**
     * Registra las horas de una iniciativa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registrarTarea(Request $request)
    {
        try{

            $input = $request->all();
            $usuario = User::find(Auth::user()->id);

            $fecha_inicio = $request->input('start');
            $fecha_fin = $request->input('end');
            $all_day = $request->input('dia');

            $date1 = DateTime::createFromFormat('D M d Y H:i:s e+', $fecha_inicio);
            $date2 = DateTime::createFromFormat('D M d Y H:i:s e+', $fecha_fin);

            $diff = $date2->diff($date1);
            $hours = $diff->h;
            $hours = $hours + ($diff->days*24);

            if($all_day)
            {
                $hours -= 1;
            }

            $req = [
                'cod_ticket' => $request->input('cod_ticket'),
                'cod_usuario' =>  $usuario->codigo,
                'horas' =>  $hours,
                'observaciones' =>  $request->input('observaciones'),
                'fecha' =>  date("Y-m-d H:i:s"),
                'fecha_inicio' => $date1->format('Y-m-d H:i:s'),
                'fecha_fin' => $date2->format('Y-m-d H:i:s'),
            ];

            $codigo = Tarea::crear($req);

            return response()->json([
                'status' => 'success',
                'id' => $codigo
            ]);

        }catch (\Exception $e){
            Custom::error('TareaController', 'registrarTarea', $e);
        }
    }

    /**
     * Actualiza una tarea
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function actualizarTarea(Request $request)
    {
        try{

            $input = $request->all();
            $usuario = User::find(Auth::user()->id);

            $fecha_inicio = $request->input('start');
            $fecha_fin = $request->input('end');

            $date1 = DateTime::createFromFormat('D M d Y H:i:s e+', $fecha_inicio);
            $date2 = DateTime::createFromFormat('D M d Y H:i:s e+', $fecha_fin);

            $diff = $date2->diff($date1);
            $hours = $diff->h;
            if($hours > 0)
            {

            }else{
                $minutes = $diff->i;
                $hours = $minutes / 60;
            }

            $req = [
                'cod_ticket' => $request->input('cod_ticket'),
                'cod_usuario' =>  $usuario->codigo,
                'horas' =>  $hours,
                'observaciones' =>  $request->input('observaciones'),
                'fecha' =>  date("Y-m-d H:i:s"),
                'fecha_inicio' => $date1->format('Y-m-d H:i:s'),
                'fecha_fin' => $date2->format('Y-m-d H:i:s'),
            ];

            $codigo = $request->input('id');

            Tarea::editar($req, $codigo);

            return response()->json([
                'status' => 'success'
            ]);

        }catch (\Exception $e){
            Custom::error('TareaController', 'registrarTarea', $e);
        }
    }

    /**
     * Elimina una tarea
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function eliminarTarea(Request $request)
    {
        try{

            $input = $request->all();
            $codigo = $request->input('id');
            $usuario = User::find(Auth::user()->id);

            Tarea::eliminar($codigo);

            return response()->json([
                'status' => 'success'
            ]);

        }catch (\Exception $e){
            Custom::error('TareaController', 'registrarTarea', $e);
        }
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
        //
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
        //
    }
}
