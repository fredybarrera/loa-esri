<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PerfilSeeder::class);
        $this->call(TipoMenuSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(PerfilMenuSeeder::class);
        $this->call(TipoSubMenuSeeder::class);
        $this->call(SubMenuSeeder::class);
    }
}
