<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Custom;
use App\Perfil;
use App\Define;
use App\Tarea;

use Session;
use Auth;
use DB;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        return view('home', ['title' => 'Home']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboardUser()
    {
        return view('home', ['title' => 'Home']);
        // dd('acaaaa user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboardAdmin()
    {
        return view('home', ['title' => 'Home']);
        // dd('acaaaa admin');
    }

    /**
     * Retorna el usuario logueado.
     *
     * @return Response
     */
    public static function getUsuario()
    {
        $usuario = User::find(Auth::user()->id);
        return ['usuario' => $usuario];
    }

    /**
     * Muestra los perfiles disponibles de un usuario
     *
     * @return Response
     */
    public function escogerPerfil()
    {
        $usuario            = User::find(Auth::user()->id);
        $perfiles           = $usuario->perfiles;
        $perfil_activo      = Session::get(Define::SESSION_PERFIL_ACTIVO);

        if($perfil_activo == null)
        {
            //Verifico si el usuario tiene mas de un perfil activo.
            if(sizeof($perfiles) > 1)
            {
                return view('auth.escoger-perfil', [
                    'perfiles' => $perfiles,
                    'title' => 'Escoger perfil'
                ]);

            }else{
                
                Session::put(Define::SESSION_PERFIL_ACTIVO, $perfiles[0]);
                return redirect('home');
            }

        }else{

            return redirect('home');
        }
    }

    /**
     * Establece el perfil del usuario
     *
     * @return Response
     */
    public function setPerfil(Request $request)
    {
        $perfil_id  = $request->input('perfil_id');
        $objPerfil  = Perfil::find($perfil_id);
        Session::put(Define::SESSION_PERFIL_ACTIVO, $objPerfil);
        Custom::log('HomeController', 'login', null);
        return redirect('escogerPerfil');
    }

     /**
     * Limpia el perfil del usuario
     *
     * @return Response
     */
    public function cambiarPerfil()
    {
        Custom::log('HomeController', 'cambiarPerfil', null);
        Session::forget(Define::SESSION_PERFIL_ACTIVO);

        return redirect('escogerPerfil');
    }

    /**
     * Logout del sistema
     *
     * @return Response
     */
    public function getLogout()
    {
        Custom::log('HomeController', 'logout', null);
        Auth::logout();
        Session::flush();

        return redirect('/login');
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


    /**
     * Update passwords users
     *
     * @param  int  $key
     * @return \Illuminate\Http\Response
     */
    public function updateDates($key)
    {
        try {
            
            if (md5($key) == '0a162e7fc31bf67ed4df116a86a2dcc7') //fbarrera
            {
                //TODO: Agrupar por usuarios

                $usuarios = User::all();

                foreach($usuarios as $usuario)
                {
                    // $tareas = Tarea::orderBy('fecha')->get();
                    $tareas = Tarea::where('cod_usuario', $usuario->codigo)->orderBy('fecha')->get();
                    // $tareas = Tarea::all();
                    
                    //Recorro las tareas y las agrupo por fecha
                    $tareas_fechas = [];
                    foreach($tareas as $tarea)
                    {
                        $fecha = date("Y-m-d", strtotime($tarea->fecha));
                        $tareas_fechas[$fecha][] = $tarea;
                    }
                    
                    foreach($tareas_fechas as $fecha => $tareas)
                    {
                        $fecha_inicio = date("Y-m-d H:i:s", strtotime($fecha . '08:30:00'));
    
                        foreach($tareas as $k => $tarea)
                        {
                            $ini = ($k==0)?$fecha_inicio:$fin;
                            $minutos_trabajados_dia = $tarea->horas * 60;
                            $aux = strtotime('+'.round($minutos_trabajados_dia).' minute', strtotime($ini)); 
                            $fin = date( 'Y-m-d H:i:s' , $aux);
                            $tarea->fecha_inicio = $ini;
                            $tarea->fecha_fin = $fin;
                            $tarea->save();
                        }
                    }
                }


                die('Tareas actualizadas');

            }else{
                die('Key inválida');
            }
        }catch (\Exception $e){
            Custom::error('TareaController', 'registrarTarea', $minutos_trabajados_dia);
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
