<?php

use Illuminate\Database\Seeder;

class PerfilMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {

            DB::table('perfil_menu')->insert([
                'perfil_id'		=> 1, // Admin
                'menu_id'		=> 1 // Dashboard admin
            ]);
            DB::table('perfil_menu')->insert([
                'perfil_id'		=> 1, // Admin
                'menu_id'		=> 2 // Mantenedores
            ]);
            DB::table('perfil_menu')->insert([
                'perfil_id'		=> 2, // Usuaario
                'menu_id'		=> 3 // Dashboard usuario
            ]);
            DB::table('perfil_menu')->insert([
                'perfil_id'		=> 2, // Usuario
                'menu_id'		=> 4 // Tareas
            ]);
        });
    }
}
