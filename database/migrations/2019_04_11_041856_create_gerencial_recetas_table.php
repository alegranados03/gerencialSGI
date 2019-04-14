<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGerencialRecetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gerencial_receta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('producto_id')->unsigned()->comment('id del producto');
            $table->foreign('producto_id')->references('id')->on('gerencial_producto');
            $table->boolean('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gerencial_receta');
    }
}
