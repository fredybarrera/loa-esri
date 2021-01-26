<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Define;
use Validator;
use DB;
use Auth;

class Menu extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menu';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'link', 'clase_icono', 'orden', 'estado', 'tipomenu_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];



    public function subMenus()
    {
        return $this->belongsToMany('App\SubMenu', 'menu_submenu', 'menu_id', 'submenu_id')->where('estado', Define::ESTADO_ACTIVO)->orderBy('orden');
    }


    public function tipoMenu()
    {
        return $this->belongsTo('App\TipoMenu', 'tipomenu_id');
    }


    public static function valida($request){

        $rules = [
            'nombre'        => 'required',
            'link'          => 'required',
            'clase_icono'   => 'required',
            'orden'         => 'required|numeric',
            'estado'        => 'required',
            'tipomenu_id'   => 'required|numeric',
        ];

        return Validator::make($request->all(), $rules);
    }



    public static function crear($req){

        $menu = new Menu;
        $menu->nombre       = $req['nombre'];
        $menu->link         = $req['link'];
        $menu->clase_icono  = $req['clase_icono'];
        $menu->orden        = $req['orden'];
        $menu->estado       = ($req['estado'] == '1' ? Define::ESTADO_ACTIVO : Define::ESTADO_INACTIVO);
        $menu->tipomenu_id  = intval($req['tipomenu_id']);
        $menu->save();

        $tipo_menu = intval($req['tipomenu_id']);

        /*
        const MENU_TIPO_MAPA            = 1;
        const MENU_TIPO_MANTENEDOR      = 2;
        const MENU_TIPO_SERVICIO        = 3;
        const MENU_TIPO_FILTRO          = 4;
        const MENU_TIPO_FUNCION         = 5;
        const MENU_TIPO_HERRAMIENTA     = 6;
        */

        if($tipo_menu == Define::MENU_TIPO_MANTENEDOR)
        {
            if(isset($req['submenu_id']) && sizeof($req['submenu_id']) > 0)
            {
                foreach ($req['submenu_id'] as $key => $submenu_id) {
                    DB::table('menu_submenu')->insert([
                        'menu_id' => $menu->id,
                        'submenu_id' => $submenu_id
                    ]);
                }
            }
        }

        return $menu->id;
    }



    public static function editar($req, $id){

        $menu               = Self::findOrFail($id);
        $menu->nombre       = $req['nombre'];
        $menu->link         = $req['link'];
        $menu->clase_icono  = $req['clase_icono'];
        $menu->orden        = $req['orden'];
        $menu->estado       = ($req['estado'] == '1' ? Define::ESTADO_ACTIVO : Define::ESTADO_INACTIVO);
        $menu->tipomenu_id  = intval($req['tipomenu_id']);
        $menu->save();
        
        $tipo_menu = intval($req['tipomenu_id']);
        
        if($req['estado'] == '1')
        {
            DB::table('menu_submenu')->where('menu_id', $menu->id)->delete();

            /*
            const MENU_TIPO_MAPA            = 1;
            const MENU_TIPO_MANTENEDOR      = 2;
            const MENU_TIPO_SERVICIO        = 3;
            const MENU_TIPO_FILTRO          = 4;
            const MENU_TIPO_FUNCION         = 5;
            const MENU_TIPO_HERRAMIENTA     = 6;
            */

            if($tipo_menu == Define::MENU_TIPO_MANTENEDOR)
            {
                if(isset($req['submenu_id']) && sizeof($req['submenu_id']) > 0)
                {
                    foreach ($req['submenu_id'] as $key => $submenu_id) {
                        DB::table('menu_submenu')->insert([
                            'menu_id' => $menu->id,
                            'submenu_id' => $submenu_id
                        ]);
                    }
                }
            }

        }else{

            //Si en la edición, se desactiva el menu, llamo a la funcion desactivar.
            Self::desactivar($id);
        }
    }



    /**
     * Inactiva el menu.
     * Si el Menú tiene submenus asociados, solo se elimina la relacion entre ellos menu_submenu.
     *
     * @var array
     */
    public static function desactivar($id){
        
        $menu = Self::findOrFail($id);

        //Elimino las relaciones de los submenus con el menu desactivado
        DB::table('menu_submenu')->where('menu_id', $menu->id)->delete();

        $menu->estado = Define::ESTADO_INACTIVO;
        $menu->save();       
    }

}
