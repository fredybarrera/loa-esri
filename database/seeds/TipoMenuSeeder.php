<?php

use Illuminate\Database\Seeder;

class TipoMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {

            DB::table('tipo_menu')->insert([
                'nombre'        => 'Mantenedor',
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
            DB::table('tipo_menu')->insert([
                'nombre'        => 'Tarea',
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
            DB::table('tipo_menu')->insert([
                'nombre'        => 'Dashboard',
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            ]);
        });
    }
}
