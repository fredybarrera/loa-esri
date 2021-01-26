<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Define;
use Validator;
use DB;
use App\Menu;

class TipoMenu extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipo_menu';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];


    public static function valida($request){

        $rules = [
            'nombre' => 'required'
        ];

        return Validator::make($request->all(), $rules);
    }


    public static function crear($req){

        $tipomenu = new TipoMenu;
        $tipomenu->nombre = $req['nombre'];
        $tipomenu->save();

        return $tipomenu->id;
    }


    public static function editar($req, $id){

        $tipomenu = Self::findOrFail($id);
        $tipomenu->nombre = $req['nombre'];
        $tipomenu->save();
    }


    /**
     * Inactiva el submenu.
     * Si el submenu tiene menus asociados, solo se elimina la relacion entre ellos menu_submenu.
     *
     * @var array
     */
    public static function desactivar($id){

        $tipomenu = Self::findOrFail($id);

        $menus = Menu::where('tipomenu_id', $id)->get();

        if(sizeof($menus) > 0)
        {
        	return false;
        }

        $tipomenu->delete();
        
        return true;
    }
}
