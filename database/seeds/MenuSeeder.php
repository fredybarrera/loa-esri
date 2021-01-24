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
                'nombre'        => 'Dashboard',
                'link'			=> 'dashboard-admin',
                'clase_icono'	=> 'mdi mdi-view-dashboard',
                'orden'			=> 1,
                'estado' 		=> 1,//\App\Define::ESTADO_ACTIVO,
                'tipomenu_id'   => 3,//\App\Define::MENU_TIPO_TAREA,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
            DB::table('menu')->insert([
                'nombre'        => 'Mantenedores',
                'link'			=> 'mantenedores',
                'clase_icono'	=> 'mdi mdi-settings',
                'orden'			=> 2,
                'estado' 		=> 1,//\App\Define::ESTADO_ACTIVO,
                'tipomenu_id'   => 1,//\App\Define::MENU_TIPO_MANTENEDOR,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
            DB::table('menu')->insert([
                'nombre'        => 'Dashboard',
                'link'			=> 'dashboard-user',
                'clase_icono'	=> 'mdi mdi-view-dashboard',
                'orden'			=> 3,
                'estado' 		=> 1,//\App\Define::ESTADO_ACTIVO,
                'tipomenu_id'   => 3,//\App\Define::MENU_TIPO_TAREA,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
            DB::table('menu')->insert([
                'nombre'        => 'Tareas',
                'link'			=> 'tarea',
                'clase_icono'	=> 'mdi mdi-border-color',
                'orden'			=> 4,
                'estado' 		=> 1,//\App\Define::ESTADO_ACTIVO,
                'tipomenu_id'   => 2,//\App\Define::MENU_TIPO_TAREA,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
        });
    }
}
