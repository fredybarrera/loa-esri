<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/home';
    protected $redirectPath = '/escogerPerfil';
    protected $loginPath = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Define el campo que será el login de usuario
     *
     * @return string
     */
    public function loginUsername()
    {
        return 'email';
    }

    /**
     * Define la ruta para el redireccionamiento al loguearse
     *
     * @return string
     */
    public function redirectPath()
    {
        return '/escogerPerfil';
    }


    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect($this->redirectPath());
    }


    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'estado' => '1']))
        {
            // Updated this line
            return $this->sendLoginResponse($request);
            // OR this one
            // return $this->authenticated($request, auth()->user());
        } else {
            return $this->sendFailedLoginResponse($request, 'auth.failed_status');
        }
    }

}
