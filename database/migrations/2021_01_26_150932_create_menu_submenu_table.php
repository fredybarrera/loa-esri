<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuSubmenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_submenu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id');
            $table->integer('submenu_id');
            $table->foreign('menu_id')->references('id')->on('menu');
            $table->foreign('submenu_id')->references('id')->on('sub_menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_submenu');
    }
}
