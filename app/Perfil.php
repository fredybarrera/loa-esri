<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Define;
use Validator;
use DB;

class Perfil extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'perfil';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    

    public function usuarios()
    {
        // return $this->belongsTo('App\Usuario');
        return $this->belongsToMany('App\User', 'usuario_perfil', 'perfil_id', 'usuario_id')->where('estado', Define::ESTADO_ACTIVO);
    }


    public function menus()
    {
    	return $this->belongsToMany('App\Menu', 'perfil_menu', 'perfil_id', 'menu_id')->where('estado', Define::ESTADO_ACTIVO)->orderBy('orden');
    }


    public static function valida($request){

        $rules = [
            'nombre'    => 'required',
            'estado'    => 'required',
            'rol_id'    => 'required|exists:roles,id',
        ];

        return Validator::make($request->all(), $rules);
    }



    public static function crear($req){

        $perfil = new Perfil;
        $perfil->nombre = $req['nombre'];
        $perfil->estado = ($req['estado'] == '1' ? Define::ESTADO_ACTIVO : Define::ESTADO_INACTIVO);
        $perfil->rol_id = $req['rol_id'];
        $perfil->save();

        if(isset($req['menu_id']))
        {
            foreach ($req['menu_id'] as $key => $menu_id) {

                DB::table('perfil_menu')->insert([
                    'perfil_id' => $perfil->id,
                    'menu_id' => $menu_id
                ]);
            }
        }

        return $perfil->id;
    }


    public static function editar($req, $id){

        $perfil         = Self::findOrFail($id);
        $perfil->nombre = $req['nombre'];

        //Si en la edición, se desactiva el perfil, llamo a la funcion desactivar.
        
        if($req['estado'] == '-1')
        {
            Self::desactivar($id);
        }

        $perfil->estado = ($req['estado'] == '1' ? Define::ESTADO_ACTIVO : Define::ESTADO_INACTIVO);
        $perfil->rol_id = $req['rol_id'];
        $perfil->save();

        //borro los anteriores
        DB::table('perfil_menu')->where('perfil_id', $perfil->id)->delete();

        if(isset($req['menu_id']))
        {
            foreach ($req['menu_id'] as $key => $menu_id) {
                DB::table('perfil_menu')->insert([
                    'perfil_id'    => $perfil->id,
                    'menu_id'     => $menu_id
                ]);
            }
        }
    }


    /**
     * Inactiva el Perfil.
     * Si el perfil tiene asociado un solo usuario, se inactiva el usuario y se elimina la relacion usuario-perfil.
     * Si el perfil tiene varios usuarios asociados, solo se elimina la relacion usuario-perfil.
     *
     * @var array
     */
    public static function desactivar($id){
        
        $perfil = Self::findOrFail($id);
        $usuarios = $perfil->usuarios;

        //Elimino las relaciones con los usuarios
        if(sizeof($usuarios) > 0)
        {
            foreach ($usuarios as $usuario) {

                //Si hay asociado un solo usuario lo desactivo
                if(sizeof($usuario->perfiles) == 1)
                {
                    $usuario->estado = Define::ESTADO_INACTIVO;
                    $usuario->save();
                }

                DB::table('usuario_perfil')
                ->where('perfil_id', $id)
                ->where('usuario_id', $usuario->id)
                ->delete();
            }
        }

        //Elimino las relaciones con usuarios y menú.
        //DB::table('perfil_menu')->where('perfil_id', $id)->delete();

        $perfil->estado = Define::ESTADO_INACTIVO;
        $perfil->save();
    }
}
