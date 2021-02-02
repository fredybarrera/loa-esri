<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Define;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return (Auth::check() && Auth::user()->getPerfilActivo()->id == Define::PERFIL_ADMIN) ? $next($request) : redirect('/');
    }
}
