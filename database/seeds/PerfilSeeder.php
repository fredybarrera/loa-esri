<?php

use Illuminate\Database\Seeder;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {

            DB::table('perfil')->insert([
                'nombre'        => 'Administrador',
                'estado'        => 1,//Define::ESTADO_ACTIVO,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
            DB::table('perfil')->insert([
                'nombre'        => 'Profesional',
                'estado'        => 1,//Define::ESTADO_ACTIVO,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
        });
    }
}
