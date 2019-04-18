<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGerencialDetalleOrdenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gerencial_detalle_orden', function (Blueprint $table) {
            $table->integer('id')->primary()->unsigned()->unique();
            $table->integer('orden_id')->unsigned()->comment('referencia a la orden a la que pertenece');
            $table->foreign('orden_id')->references('id')->on('gerencial_orden')->onDelete('cascade');
            $table->integer('producto_id')->unsigned()->comment('id del producto que está en la orden');
            $table->foreign('producto_id')->references('id')->on('gerencial_producto');
            $table->integer('cantidad_producto')->comment('cantidad comprada');
            $table->decimal('total_parcial',8,2)->comment('total parcial por detalle de la orden');
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
        Schema::dropIfExists('gerencial_detalle_orden');
    }
}
