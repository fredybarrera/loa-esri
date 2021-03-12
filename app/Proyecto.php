<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Proyecto extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'proyecto';

    protected $primaryKey = 'codigo';
    
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo', 'nombre', 'descripcion', 'cod_usuario_res', 'estado'
    ];

    public function tickets()
    {
        return $this->hasMany('App\Ticket', 'cod_proyecto');
    }

    public function usuario()
    {
        return $this->belongsTo('App\User', 'cod_usuario_res', 'codigo');
    }

    public static function valida($request){

        $rules = [
            'nombre'            => 'required',
            'descripcion'       => 'required',
            'estado'            => 'required',
            'cod_usuario_res'   => 'required|numeric',
        ];

        return Validator::make($request->all(), $rules);
    }

    public static function crear($req){

        $obj                    = new Self;
        $obj->nombre            = $req['nombre'];
        $obj->descripcion       = $req['descripcion'];
        $obj->cod_usuario_res   = $req['cod_usuario_res'];
        $obj->estado            = $req['estado'];
        $obj->save();
    }

    public static function editar($req, $id){
        $obj                    = Self::findOrFail($id);
        $obj->nombre            = $req['nombre'];
        $obj->descripcion       = $req['descripcion'];
        $obj->cod_usuario_res   = $req['cod_usuario_res'];
        $obj->estado            = $req['estado'];
        $obj->save();
    }


     /**
     * Inactiva el proyecto.
     * @var array
     */
    public static function desactivarActivar($id){
        
        $obj = Self::findOrFail($id);
        $obj->estado = ($obj->estado == Define::ESTADO_INACTIVO) ? Define::ESTADO_ACTIVO : Define::ESTADO_INACTIVO;
        $obj->save();
    }
}
