<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGerencialPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gerencial_pago', function (Blueprint $table) {
            $table->integer('id')->primary()->unsigned()->unique();
            $table->integer('orden_id')->unsigned()->comment('referencia a la orden');
            $table->foreign('orden_id')->references('id')->on('gerencial_orden');
            $table->ENUM('tipo_pago',['Efectivo','Tarjeta Crédito','PayPal']);
            $table->decimal('total_cancelar',8,2);
            $table->timestamp('fecha_pago')->comment('fecha en que se realizó el pago');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gerencial_pago');
    }
}
