<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialActividadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_actividad', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable()->comment('id del usuario del sistema al que está relacionada la actividad');
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('registro_etl')->nullable(0)->comment('identifica si la actividad es del sistema ETL (estado True) o de un usuario del sistema gerencial (estado False)');
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
        Schema::dropIfExists('historial_actividad');
    }
}
