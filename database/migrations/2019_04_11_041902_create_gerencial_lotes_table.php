<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGerencialLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gerencial_lote', function (Blueprint $table) {
            $table->integer('id')->primary()->unsigned()->unique();
            $table->integer('producto_id')->unsigned()->comment('id del producto que contiene el lote');
            $table->foreign('producto_id')->references('id')->on('gerencial_producto');
            $table->decimal('total',8,2)->comment('valor del lote del producto');
            $table->integer('proveedor_id')->unsigned()->nullable();
            $table->foreign('proveedor_id')->references('id')->on('gerencial_proveedor')->default(NULL);
            $table->timestamp('fecha_registro');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gerencial_lote');
    }
}
