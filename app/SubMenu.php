<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Define;
use Validator;
use DB;

class SubMenu extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sub_menu';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'link', 'orden', 'estado', 'tipo_submenu_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];



    public function menus()
    {
        return $this->belongsToMany('App\Menu', 'menu_submenu', 'submenu_id', 'menu_id')->where('estado', Define::ESTADO_ACTIVO)->orderBy('orden');
    }


    public function tipoSubmenu()
    {
        return $this->belongsTo('App\TipoSubMenu', 'tipo_submenu_id');
    }


    public static function valida($request){

        $rules = [
            'nombre'            => 'required',
            'link'              => 'required',
            'orden'             => 'required|numeric',
            'estado'            => 'required',
            'tipo_submenu_id'    => 'required|numeric',
        ];

        return Validator::make($request->all(), $rules);
    }


    public static function crear($req){

        $submenu = new SubMenu;
        $submenu->nombre            = $req['nombre'];
        $submenu->link              = $req['link'];
        $submenu->orden             = $req['orden'];
        $submenu->estado            = ($req['estado'] == '1' ? Define::ESTADO_ACTIVO : Define::ESTADO_INACTIVO);
        $submenu->tipo_submenu_id    = intval($req['tipo_submenu_id']);
        $submenu->save();

        return $submenu->id;
    }


    public static function editar($req, $id){

        $submenu                    = Self::findOrFail($id);
        $submenu->nombre            = $req['nombre'];
        $submenu->link              = $req['link'];
        $submenu->orden             = $req['orden'];
        $submenu->estado            = ($req['estado'] == '1' ? Define::ESTADO_ACTIVO : Define::ESTADO_INACTIVO);
        $submenu->tipo_submenu_id    = intval($req['tipo_submenu_id']);
        $submenu->save();

        if($req['estado'] == '-1')
        {
            //Elimino las relaciones de los menus con el submenu desactivado.
            DB::table('menu_submenu')->where('submenu_id', $submenu->id)->delete();
        }
    }


    /**
     * Inactiva el submenu.
     * Si el submenu tiene menus asociados, solo se elimina la relacion entre ellos menu_submenu.
     *
     * @var array
     */
    public static function desactivar($id){
        
        $submenu = Self::findOrFail($id);

        //Elimino las relaciones de los menus con el submenu desactivado.
        DB::table('menu_submenu')->where('submenu_id', $submenu->id)->delete();

        $submenu->estado = Define::ESTADO_INACTIVO;
        $submenu->save();       
    }
}
