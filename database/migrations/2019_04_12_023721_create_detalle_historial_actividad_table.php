<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleHistorialActividadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_historial_actividad', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('historial_id')->unsigned();
            $table->foreign('historial_id')->references('id')->on('historial_actividad');
            $table->string('comentario_de_actividad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_historial_actividad');
    }
}
