<?php

namespace App;
use Auth;
use Session;
use App\Define;
use App\Utiles;

use Illuminate\Database\Eloquent\Model;

class Custom
{
    /**
     * Genera un registro en la tabla de losg de errores.
     *
     * @param  Request  $request
     * @return Response
     */
	public static function error($clase, $metodo, $e, $detalle=null)
	{
		dd($e);
		// $usuario_id 	= Auth::user()->id;
		// $perfil_activo  = Session::get(Define::SESSION_PERFIL_ACTIVO);
		// $perfil_id  	= $perfil_activo->id;
		// $error 			= $e->getMessage();
		// $linea 			= $e->getLine();

		// $data = [
		// 	'usuario_id' => $usuario_id,
		// 	'perfil_id' => $perfil_id,
		// 	'clase' => $clase,
		// 	'metodo' => $metodo,
		// 	'error' => $error,
		// 	'linea' => $linea,
		// 	'detalle' => ($detalle)?json_encode($detalle):$detalle
		// ];
 		
		// LogErrores::crear($data);

 		// abort(503);
	}


	/**
     * Genera un registro en la tabla de losg de errores.
     *
     * @param  Request  $request
     * @return Response
     */
	public static function errorJs($req)
	{
		// $usuario_id 	= Auth::user()->id;
		// $perfil_activo  = Session::get(Define::SESSION_PERFIL_ACTIVO);
		// $perfil_id  	= $perfil_activo->id;

		// $data = [
		// 	'usuario_id' => $usuario_id,
		// 	'perfil_id' => $perfil_id,
		// 	'clase' => $req['clase'],
		// 	'metodo' => $req['metodo'],
		// 	'error' => $req['error'],
		// 	'linea' => $req['linea'],
		// 	'detalle' => (isset($req['detalle']) && $req['detalle'])?json_encode($req['detalle']):null
		// ];

		// LogErrores::crear($data);
	}



	/**
     * Genera un registro en la tabla de logs del sistema.
     *
     * @param  Request  $request
     * @return Response
     */
	public static function log($controller, $accion, $detalle=null)
	{
		// $usuario_id 	= Auth::user()->id;
		// $perfil_activo  = Session::get(Define::SESSION_PERFIL_ACTIVO);
		// $perfil_id  	= $perfil_activo->id;
		// $ip  			= Utiles::getIp();

		// $data = [
		// 	'usuario_id' => $usuario_id,
		// 	'perfil_id' => $perfil_id,
		// 	'controller' => $controller,
		// 	'accion' => $accion,
		// 	'ip' => $ip,
		// 	'detalle' => ($detalle)?json_encode($detalle):$detalle
		// ];

		// LogSistema::crear($data);
	}


	/**
     * Retorna el menú del usuario.
     *
     * @return Response
     */
    public static function getMenu()
    {
        $perfil_activo = Session::get(Define::SESSION_PERFIL_ACTIVO);
		$perfil_activo->load(['menus']);
        return ['menus' => $perfil_activo->menus];
    }
}
