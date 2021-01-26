<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Define;
use Validator;
use DB;
use App\SubMenu;

class TipoSubMenu extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipo_submenu';

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


    public function subMenus()
    {
        return $this->hasMany('App\SubMenu');
    }


    public static function valida($request){

        $rules = [
            'nombre' => 'required'
        ];

        return Validator::make($request->all(), $rules);
    }


    public static function crear($req){

        $tiposubmenu = new TipoSubMenu;
        $tiposubmenu->nombre = $req['nombre'];
        $tiposubmenu->save();

        return $tiposubmenu->id;
    }


    public static function editar($req, $id){

        $tiposubmenu = Self::findOrFail($id);
        $tiposubmenu->nombre = $req['nombre'];
        $tiposubmenu->save();
    }


    /**
     * Inactiva el submenu.
     * Si el submenu tiene menus asociados, solo se elimina la relacion entre ellos menu_submenu.
     *
     * @var array
     */
    public static function desactivar($id){

        $tipomenu = Self::findOrFail($id);

        $submenu = SubMenu::where('tipo_submenu_id', $id)->get();

        if(sizeof($submenu) > 0)
        {
        	return false;
        }

        $tipomenu->delete();
        
        return true;
    }
}
