<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGerencialDetalleRecetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gerencial_detalle_receta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('receta_id')->unsigned();
            $table->foreign('receta_id')->references('id')->on('gerencial_receta');
            $table->integer('materiaPrima_id')->unsigned();
            $table->foreign('materiaPrima_id')->references('id')->on('gerencial_materia_prima');
            $table->decimal('cantidad_individual',8,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gerencial_detalle_receta');
    }
}
