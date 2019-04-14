<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGerencialProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gerencial_producto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_producto',100);
            $table->integer('stock')->comment('cantidad actual en inventario');
            $table->integer('categoria_id')->unsigned()->comment('categoria a la que pertenece');
            $table->foreign('categoria_id')->references('id')->on('gerencial_categoria');
            $table->decimal('precio',8,2)->comment('precio de venta');
            $table->string('descripcion');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gerencial_producto');
    }
}
