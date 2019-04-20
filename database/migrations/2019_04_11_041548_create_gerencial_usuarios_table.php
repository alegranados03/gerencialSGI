<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGerencialUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gerencial_usuario', function (Blueprint $table) {
            $table->integer('id')->unsigned()->primary()->unique()->comment('id del usuario registrado en el sistema transaccional');
            $table->string('username');
            $table->boolean('es_cliente')->comment('identifica si el usuario es un cliente');
            $table->ENUM('sexo',['M','F'])->comment('M=> Masculino F=> Femenino');
            $table->timestamp('fecha_registro')->comment('Fecha en que se registró el usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gerencial_usuario');
    }
}
