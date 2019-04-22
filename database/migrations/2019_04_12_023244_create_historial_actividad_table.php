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
            $table->ENUM('registro_etl',['True','False'])->default('False')->comment('identifica si la actividad es del sistema ETL (estado True) o de un usuario del sistema gerencial (estado False)');
            $table->string('comentario_de_actividad')->comment('Registra la acción que ha realizado el usuario');
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
