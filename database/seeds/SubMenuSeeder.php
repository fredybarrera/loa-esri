<?php

use Illuminate\Database\Seeder;

class SubMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {

            DB::table('sub_menu')->insert([
                'nombre'        => 'Usuarios',
                'link'			=> 'usuario',
                'orden'			=> 1,
                'estado' 		=> 1, //Define::ESTADO_ACTIVO,
                'menu_id'       => 2, // Mantenedor
                'tipo_submenu_id'   => 1, // Mantenedor
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
            DB::table('sub_menu')->insert([
                'nombre'        => 'Perfiles',
                'link'			=> 'perfil',
                'orden'			=> 2,
                'estado' 		=> 1, //Define::ESTADO_ACTIVO
                'menu_id'       => 2, // Mantenedor,
                'tipo_submenu_id'   => 1, // Mantenedor
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
            DB::table('sub_menu')->insert([
                'nombre'        => 'Iniciativas',
                'link'			=> 'iniciativa',
                'orden'			=> 3,
                'estado' 		=> 1, //Define::ESTADO_ACTIVO
                'menu_id'       => 2, // Mantenedor,
                'tipo_submenu_id'   => 1, // Mantenedor
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
            DB::table('sub_menu')->insert([
                'nombre'        => 'Actividad',
                'link'			=> 'actividad',
                'orden'			=> 4,
                'estado' 		=> 1, //Define::ESTADO_ACTIVO
                'menu_id'       => 2, // Mantenedor,
                'tipo_submenu_id'   => 1, // Mantenedor
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
            DB::table('sub_menu')->insert([
                'nombre'        => 'Ticket',
                'link'			=> 'ticket',
                'orden'			=> 5,
                'estado' 		=> 1, //Define::ESTADO_ACTIVO
                'menu_id'       => 2, // Mantenedor,
                'tipo_submenu_id'   => 1, // Mantenedor
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
            DB::table('sub_menu')->insert([
                'nombre'        => 'Area',
                'link'			=> 'area',
                'orden'			=> 6,
                'estado' 		=> 1, //Define::ESTADO_ACTIVO
                'menu_id'       => 2, // Mantenedor,
                'tipo_submenu_id'   => 1, // Mantenedor
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);



            DB::table('sub_menu')->insert([
                'nombre'        => 'Menús',
                'link'          => 'menu',
                'orden'         => 10,
                'estado'        => 1,//Define::ESTADO_ACTIVO,
                'menu_id'       => 2, // Mantenedor
                'tipo_submenu_id'   => 1,//\App\Define::SUBMENU_TIPO_MANTENEDOR,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
    
            DB::table('sub_menu')->insert([
                'nombre'        => 'SubMenús',
                'link'          => 'submenu',
                'orden'         => 11,
                'estado'        => 1,//Define::ESTADO_ACTIVO,
                'menu_id'       => 2, // Mantenedor
                'tipo_submenu_id'   => 1,//\App\Define::SUBMENU_TIPO_MANTENEDOR,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
    
            DB::table('sub_menu')->insert([
                'nombre'        => 'Tipo Menú',
                'link'          => 'tipomenu',
                'orden'         => 12,
                'estado'        => 1,//Define::ESTADO_ACTIVO,
                'menu_id'       => 2, // Mantenedor
                'tipo_submenu_id'   => 1,//\App\Define::SUBMENU_TIPO_MANTENEDOR,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
            DB::table('sub_menu')->insert([
                'nombre'        => 'Tipo SubMenú',
                'link'          => 'tiposubmenu',
                'orden'         => 13,
                'estado'        => 1,//Define::ESTADO_ACTIVO,
                'menu_id'       => 2, // Mantenedor
                'tipo_submenu_id'   => 1,//\App\Define::SUBMENU_TIPO_MANTENEDOR,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
        });
    }
}
