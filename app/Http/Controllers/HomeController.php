<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Custom;
use App\Perfil;
use App\Define;

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

    
}
