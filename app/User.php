<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Storage;
use File;
use DB;
use Session;
use Auth;
use App\Custom;
use App\Define;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'usuario';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo', 'nom_usuario', 'cod_area', 'nombres', 'apellidos', 'perfil', 'email', 'correo', 'estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',  'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Retorna los perfiles que posee el usuario
     *
     * @var array
     */
    public function perfiles()
    {
        return $this->belongsToMany('App\Perfil', 'usuario_perfil', 'usuario_id', 'perfil_id')->orderBy('nombre');
    }

    /**
     * Retorna los tickets que posee el usuario
     *
     * @var array
     */
    public function tickets()
    {
        return $this->belongsToMany('App\Ticket', 'usuario_ticket', 'cod_usuario', 'cod_ticket', 'codigo')->orderBy('descripcion');
    }


    
    public static function validaGuardar($request){

        $rules = [
            'nombres'       => 'required',
            'apellidos'     => 'required',
            'nom_usuario'   => 'required',
            'email'         => 'required|email|max:255|unique:usuario',
            'estado'        => 'required',
            'password'      => 'required|same:password_confirmation'
        ];
                
        return Validator::make($request->all(), $rules);
    }


    public static function crearUsuario($req)
    {
        date_default_timezone_set('America/Santiago');
        
        $usuario                = new User;
        $usuario->nombre        = $req['nombre'];
        $usuario->apellidos     = $req['apellidos'];
        $usuario->foto          = 'sin_foto.png';
        $usuario->estado        = ($req['estado'] == '1' ? Define::ESTADO_ACTIVO : Define::ESTADO_INACTIVO);
        $usuario->email         = $req['email'];
        $usuario->password      = bcrypt($req['password']);
        $usuario->save();

        Custom::log('UsuarioController', 'store', [
            'id' => $usuario->id,
            'nombre' => $req['nombre'] .''. $req['apellidos'],
            'correo' => $req['email'],
            'fecha' => date("Y-m-d H:i:s")
        ]);

        foreach ($req['perfil_id'] as $key => $perfil_id) {
            DB::table('usuario_perfil')->insert([
                'usuario_id'    => $usuario->id,
                'perfil_id'     => $perfil_id
            ]);
        }

        return $usuario->id;
    }

    public static function validaEditar($request, $id){

        $rules = [
            'nombres'       => 'required',
            'apellidos'     => 'required',
            'nom_usuario'   => 'required',
            'email'         => 'required|email|unique:usuario,email,'.$id,
            'estado'        => 'required',
            'password'      => 'same:password_confirmation'
        ];
        
        return Validator::make($request->all(), $rules);
    }
    
    public static function editarUsuario($req, $id){
        try{
            // DB::enableQueryLog();
            date_default_timezone_set('America/Santiago');

            $usuario                = Self::findOrFail($id);
            $usuario->nombres       = $req['nombres'];
            $usuario->apellidos     = $req['apellidos'];
            $usuario->nom_usuario   = $req['nom_usuario'];
            $usuario->estado        = ($req['estado'] == '1' ? Define::ESTADO_ACTIVO : Define::ESTADO_INACTIVO);
            $usuario->email         = $req['email'];
            if($req['password'] != '') $usuario->password = bcrypt($req['password']);
            $usuario->save();

            // Custom::log('UsuarioController', 'update', [
            //     'id' => $id,
            //     'nombre' => $req['nombre'] .''. $req['apellidos'],
            //     'correo' => $req['email'],
            //     'fecha' => date("Y-m-d H:i:s")
            // ]);

            //borro los perfiles anteriores
            DB::table('usuario_perfil')->where('usuario_id', $usuario->id)->delete();
            
            if(isset($req['perfil_id']))
            {
                foreach ($req['perfil_id'] as $key => $perfil_id) {
                    DB::table('usuario_perfil')->insert([
                        'usuario_id' => $usuario->id,
                        'perfil_id' => $perfil_id
                    ]);
                }
            }

            //borro los tickets anteriores
            DB::table('usuario_ticket')->where('cod_usuario', $usuario->codigo)->delete();
            if(isset($req['ticket_id']))
            {
                foreach ($req['ticket_id'] as $key => $cod_ticket) {
                    DB::table('usuario_ticket')->insert([
                        'cod_usuario' => $usuario->codigo,
                        'cod_ticket' => intval($cod_ticket),
                        'horas' => 40
                    ]);
                }
            }
            
            // $queryLog = DB::getQueryLog();
            
        }catch (\Exception $e){
            Custom::error('User', 'editarUsuario', $e);
        }
    }


    public static function validaEditarMisDatos($request){

        $rules = [
            'nombre'        => 'required',
            'apellidos'     => 'required',
            // 'email'         => 'required|email|unique:usuarios,id,'.$id,
            'password'      => 'same:password_confirmation'
        ];
        
        return Validator::make($request->all(), $rules);
    }


    /**
     * Inactiva el usuario.
     * El usuario mantiene todas sus configuraciones, pero no puede ingresar al sistema.
     *
     * @var array
     */
    public static function desactivar($id){
        
        $obj = Self::findOrFail($id);
        $obj->estado = Define::ESTADO_INACTIVO;
        $obj->save();
    }


    /**
     * Activa el usuario.
     *
     * @var array
     */
    public static function activar($id){
        
        $obj = Self::findOrFail($id);
        $obj->estado = Define::ESTADO_ACTIVO;
        $obj->save();
    }

    public static function editarMisDatos($req, $request){
        
        $usuario                = Self::findOrFail($req['id']);
        $usuario->nombre        = $req['nombre'];
        $usuario->apellidos     = $req['apellidos'];
        // $usuario->email         = $req['email'];
        if($req['password'] != '') $usuario->password = bcrypt($req['password']);

        if($request->hasFile('foto'))
        {
            $imagen = $request->file('foto');
            $nombre = md5($usuario->id).'.'.$imagen->guessExtension();

            if(Storage::disk('usuario')->exists($nombre))
            {
                File::delete($nombre); //640 * 640
            }

            Storage::disk('usuario')->put($nombre, File::get($imagen));
            $usuario->foto  = $nombre;
        }

        $usuario->save();
    }

    public function getPerfilActivo()
    {
        $perfil_activo = Session::get(Define::SESSION_PERFIL_ACTIVO);
        return $perfil_activo;
    }

}
