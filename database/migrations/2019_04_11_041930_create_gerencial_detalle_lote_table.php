<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGerencialDetalleLoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gerencial_detalle_lote', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_lote')->unsigned()->comment('id del lote al que está relacionado');
            $table->foreign('id_lote')->references('id')->on('gerencial_lote');
            $table->integer('cantidad_unidades');
            $table->timestamp('fecha_creacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gerencial_detalle_lote');
    }
}
