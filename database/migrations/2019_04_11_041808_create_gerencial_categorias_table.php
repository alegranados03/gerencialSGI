<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGerencialCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gerencial_categoria', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_categoria')->comment('nombre de la categoría');
            $table->string('descripcion')->comment('descripción de la categoría');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gerencial_categoria');
    }
}
