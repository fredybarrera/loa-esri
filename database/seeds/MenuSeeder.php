<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {

            DB::table('menu')->insert([
                'nombre'        => 'Home',
                'link'			=> 'dashboard-admin',
                'clase_icono'	=> 'ion ion-ios-home',
                'orden'			=> 1,
                'estado' 		=> 1,//\App\Define::ESTADO_ACTIVO,
                'tipomenu_id'   => 3,//\App\Define::MENU_TIPO_TAREA,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
            DB::table('menu')->insert([
                'nombre'        => 'Mantenedores',
                'link'			=> 'mantenedores',
                'clase_icono'	=> 'ion ion-ios-build',
                'orden'			=> 2,
                'estado' 		=> 1,//\App\Define::ESTADO_ACTIVO,
                'tipomenu_id'   => 1,//\App\Define::MENU_TIPO_MANTENEDOR,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
            DB::table('menu')->insert([
                'nombre'        => 'Home',
                'link'			=> 'dashboard-profesional',
                'clase_icono'	=> 'ion ion-ios-home',
                'orden'			=> 3,
                'estado' 		=> 1,//\App\Define::ESTADO_ACTIVO,
                'tipomenu_id'   => 3,//\App\Define::MENU_TIPO_TAREA,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
            DB::table('menu')->insert([
                'nombre'        => 'Tareas',
                'link'			=> 'tarea',
                'clase_icono'	=> 'ion ion-md-calendar',
                'orden'			=> 4,
                'estado' 		=> 1,//\App\Define::ESTADO_ACTIVO,
                'tipomenu_id'   => 2,//\App\Define::MENU_TIPO_TAREA,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
        });
    }
}
