<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Tarea extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tarea';

    protected $primaryKey = 'codigo';
    
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo', 'cod_ticket', 'cod_usuario', 'horas', 'observaciones', 'fecha'
    ];

    public function ticket()
    {
        return $this->belongsTo('App\Ticket', 'cod_ticket');
    }

    public function usuario()
    {
        return $this->belongsTo('App\User', 'cod_usuario');
    }

    public static function valida($request){

        $rules = [
            'cod_ticket'        => 'required|numeric',
            'cod_usuario'       => 'required|numeric',
            'horas'             => 'required|numeric',
            'observaciones'     => 'required',
            'fecha'             => 'required',
        ];

        return Validator::make($request->all(), $rules);
    }


    public static function crear($req){

        $obj                  = new Self;
        $obj->cod_ticket      = $req['cod_ticket'];
        $obj->cod_usuario     = $req['cod_usuario'];
        $obj->horas           = $req['horas'];
        $obj->observaciones   = $req['observaciones'];
        $obj->fecha           = $req['fecha'];
        $obj->save();

        return $obj->codigo;
    }


    public static function editar($req, $id){

        $obj                    = Self::findOrFail($id);
        $obj->cod_ticket        = $req['cod_ticket'];
        $obj->cod_usuario       = $req['cod_usuario'];
        $obj->horas             = $req['horas'];
        $obj->observaciones     = $req['observaciones'];
        $obj->fecha             = $req['fecha'];
        $obj->save();
    }


    /**
     * @var array
     */
    public static function eliminar($id){
        
        $obj = Self::findOrFail($id);
        $obj->delete();

        return true;      
    }
}
