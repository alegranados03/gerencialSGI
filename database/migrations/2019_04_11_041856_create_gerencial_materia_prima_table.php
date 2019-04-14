<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGerencialMateriaPrimaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gerencial_materia_prima', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_materia')->comment('nombre de la materia prima');
            $table->integer('cantidad')->comment('cantidad actual de materia prima');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gerencial_materia_prima');
    }
}
