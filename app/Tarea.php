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
        'codigo', 'cod_ticket', 'cod_usuario', 'horas', 'observaciones', 'fecha', 'fecha_inicio', 'fecha_fin'
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
            'fecha_inicio'      => 'required',
            'fecha_fin'         => 'required',
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
        $obj->fecha_inicio    = $req['fecha_inicio'];
        $obj->fecha_fin       = $req['fecha_fin'];
        $obj->save();

        return $obj->codigo;
    }


    public static function editar($req, $codigo){

        $obj                    = Self::findOrFail($codigo);
        $obj->cod_ticket        = $req['cod_ticket'];
        $obj->cod_usuario       = $req['cod_usuario'];
        $obj->horas             = $req['horas'];
        $obj->observaciones     = $req['observaciones'];
        $obj->fecha             = $req['fecha'];
        $obj->fecha_inicio      = $req['fecha_inicio'];
        $obj->fecha_fin         = $req['fecha_fin'];
        $obj->save();
    }


    /**
     * @var array
     */
    public static function eliminar($codigo){
        
        $obj = Self::findOrFail($codigo);
        $obj->delete();

        return true;      
    }
}
