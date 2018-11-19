<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('Pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('alumxapo_id');
            $table->unsignedInteger('cuota_id');
            $table->decimal('total',6,2);
            $table->enum('estado',['ACTIVO','MOROSO','INHABILITADO']);
            $table->foreign('alumxapo_id')->references('id')->on('alumxapo');
            $table->foreign('cuota_id')->references('id')->on('Cuota');
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
        Schema::dropIfExists('_pagos');
    }
}
