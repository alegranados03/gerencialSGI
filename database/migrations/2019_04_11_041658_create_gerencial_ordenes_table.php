<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGerencialOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gerencial_orden', function (Blueprint $table) {
            $table->increments('id')->comment('id de las ordenes, vienen registradas desde sistema transaccional');
            $table->string('codigo_seguimiento',150)->comment('código de seguimiento de las órdenes');
            $table->ENUM('tipo_orden',['LOCAL', 'EN LINEA'])->comment('Donde se registró la compra, si en la tienda en linea o local');
            $table->integer('user_id')->unsigned()->comment('referencia al usuario registrado en el sistema transaccional');
            $table->foreign('user_id')->references('id')->on('gerencial_usuario');
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
        Schema::dropIfExists('gerencial_orden');
    }
}
