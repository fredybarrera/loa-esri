<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use DB;
use App\Custom;
use App\Define;

class Ticket extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ticket';

    protected $primaryKey = 'codigo';
    
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo', 'cod_proyecto', 'descripcion', 'notas', 'activo', 'creacion', 'plazo', 'cod_usuario_sol', 'cod_usuario_res'
    ];

    public function proyecto()
    {
        return $this->belongsTo('App\Proyecto', 'cod_proyecto', 'codigo');
    }

    public function responsable()
    {
        return $this->belongsTo('App\User', 'cod_usuario_res', 'codigo');
    }

    public function solicitante()
    {
        return $this->belongsTo('App\User', 'cod_usuario_sol', 'codigo');
    }

    public function usuarios()
    {
        // return $this->belongsToMany('App\Ticket', 'usuario_ticket', 'cod_usuario', 'cod_ticket', 'codigo')->orderBy('descripcion');
        return $this->belongsToMany('App\User', 'usuario_ticket', 'cod_ticket', 'cod_usuario', 'codigo', 'codigo')->orderBy('nombres');
    }


    public static function valida($request){

        $rules = [
            'cod_proyecto'       => 'required|numeric',
            'descripcion'        => 'required',
            'notas'              => 'required',
            'activo'             => 'required',
            'cod_usuario_sol'    => 'required',
            'cod_usuario_res'    => 'required',
        ];

        return Validator::make($request->all(), $rules);
    }


    public static function crear($req){
        $obj                    = new Self;
        $obj->cod_proyecto      = $req['cod_proyecto'];
        $obj->descripcion       = $req['descripcion'];
        $obj->notas             = $req['notas'];
        $obj->activo            = $req['activo'];
        $obj->creacion          = date('Y-m-d H:i:s');
        $obj->plazo             = $req['plazo'];
        $obj->cod_usuario_sol   = $req['cod_usuario_sol'];
        $obj->cod_usuario_res   = $req['cod_usuario_res'];
        $obj->save();

        $ticket = $obj->fresh();

        if(isset($req['usuario_id']))
        {
            foreach ($req['usuario_id'] as $key => $codigo) {
                DB::table('usuario_ticket')->insert([
                    'cod_usuario' => intval($codigo),
                    'cod_ticket' => $ticket->codigo,
                    'horas' => 40
                ]);
            }
        }

        return $ticket->codigo;
    }


    public static function editar($req, $id){

        $obj                    = Self::findOrFail($id);
        $obj->cod_proyecto      = $req['cod_proyecto'];
        $obj->descripcion       = $req['descripcion'];
        $obj->notas             = $req['notas'];
        $obj->activo            = $req['activo'];
        $obj->plazo             = $req['plazo'];
        $obj->cod_usuario_sol   = $req['cod_usuario_sol'];
        $obj->cod_usuario_res   = $req['cod_usuario_res'];
        $obj->save();

        //borro los tickets anteriores
        DB::table('usuario_ticket')->where('cod_ticket', $obj->codigo)->delete();
        if(isset($req['usuario_id']))
        {
            foreach ($req['usuario_id'] as $key => $codigo) {
                DB::table('usuario_ticket')->insert([
                    'cod_usuario' => intval($codigo),
                    'cod_ticket' => $obj->codigo,
                    'horas' => 40
                ]);
            }
        }
    }


    /**
     * Inactiva el ticket.
     * @var array
     */
    public static function desactivarActivar($id){
        
        $obj = Self::findOrFail($id);
        $obj->activo = ($obj->activo == Define::ESTADO_INACTIVO_TEXTO) ? Define::ESTADO_ACTIVO_TEXTO : Define::ESTADO_INACTIVO_TEXTO;
        $obj->save();
    }
}
