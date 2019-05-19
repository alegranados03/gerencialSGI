<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGerencialComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gerencial_compra', function (Blueprint $table) {
            $table->integer('id')->primary()->unsigned()->unique();
            $table->integer('materia_prima_id')->unsigned();
            $table->foreign('materia_prima_id')->references('id')->on('gerencial_materia_prima');
            $table->integer('proveedor_id')->unsigned()->comment('id del proveedor al que le compra la panaderia');
            $table->foreign('proveedor_id')->references('id')->on('gerencial_proveedor');
            $table->integer('cantidad');
            $table->decimal('costo_compra',8,2)->comment('costo de adquisición de materia prima');
            $table->timestamp('fecha_compra')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gerencial_compra');
    }
}
