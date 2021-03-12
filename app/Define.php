<?php

namespace App;
use Config;
use Auth;

use Illuminate\Database\Eloquent\Model;

class Define
{
    /*
    |--------------------------------------------------------------------------
    | Estados generales de las tablas
    |--------------------------------------------------------------------------
    */
    const ESTADO_INACTIVO   = -1;
    const ESTADO_ACTIVO     = 1;
   	/*
    |--------------------------------------------------------------------------
    | Perfiles de usuario
    |--------------------------------------------------------------------------
    */
	const PERFIL_ADMIN          = 1;
    const PERFIL_PROFESIONAL    = 2;
	/*
    |--------------------------------------------------------------------------
    | Variables de sesión
    |--------------------------------------------------------------------------
    */
    const SESSION_PERFIL_ACTIVO = 'PERFIL_ACTIVO';
    const SESSION_MENU = 'SESSION_MENU';
    /*
    |--------------------------------------------------------------------------
    | Tipos de Menú
    |--------------------------------------------------------------------------
    */
    const MENU_TIPO_MANTENEDOR      = 1;
    const MENU_TIPO_TAREA           = 2;
    const MENU_TIPO_DASHBOARD       = 3;
    /*
    |--------------------------------------------------------------------------
    | Tipos de Sub Menú
    |--------------------------------------------------------------------------
    */
    const SUBMENU_TIPO_MANTENEDOR  = 1;
    /*
    |--------------------------------------------------------------------------
    | Condiciones validacion
    |--------------------------------------------------------------------------
    */
    const VALIDACION_SI  = 1;
    const VALIDACION_NO  = 2;
    /*
    |--------------------------------------------------------------------------
    | Tickets
    |--------------------------------------------------------------------------
    */
    const TICKET_VACACIONES  = 81;
    /*

    /**
     * Retorna los tipos de Menús
     *
     * @var array
     */
    public static function getTiposMenu($json = false){

        $menu_tipo = [
            Define::MENU_TIPO_MANTENEDOR  => 'Mantenedor',
            Define::MENU_TIPO_TAREA       => 'Tarea',
            Define::MENU_TIPO_DASHBOARD   => 'Dashboard'
        ];

        if($json)
        {
            return json_encode($menu_tipo);
        }
        
        return $menu_tipo;
    }


    /**
     * Retorna los tipos de SubMenús
     *
     * @var array
     */
    public static function getTiposSubMenu(){
        
        return [
            Define::SUBMENU_TIPO_MANTENEDOR => 'Mantenedor'
        ];
    }


    /**
     * Retorna las condiciones para una validación
     *
     * @var array
     */
    public static function getCondicionesValidacion(){
        
        return [
            Define::VALIDACION_SI => 'Permitido',
            Define::VALIDACION_NO => 'No Permitido'
        ];
    }


    /**
     * Retorna las condiciones para una validación
     *
     * @var array
     */
    public static function getEstados(){
        
        return [
            Define::ESTADO_ACTIVO => 'Activo',
            Define::ESTADO_INACTIVO => 'Inactivo'
        ];
    }



    /**
     * Retorna el lifetime de la sesion
     *
     * @var array
     */
    public static function getLifetime(){
        return Config::get('session.lifetime');
    }

    /**
     * Retorna si el usuario está logueado o no.
     *
     * @var array
     */
    public static function ckeckSession(){
        return Auth::check();
    }
}
