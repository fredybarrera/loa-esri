<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Define;
use Validator;
use DB;


class TipoProyecto extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipo_proyecto';

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
        $obj = new TipoProyecto;
        $obj->nombre = $req['nombre'];
        $obj->save();

        return $obj->id;
    }


    public static function editar($req, $id){
        $obj = Self::findOrFail($id);
        $obj->nombre = $req['nombre'];
        $obj->save();
    }


    /**
     * Elimina el tipo de proyecto.
     *
     * @var array
     */
    public static function desactivar($id){

        $obj = Self::findOrFail($id);
        $obj->delete();
        
        return true;
    }
}
