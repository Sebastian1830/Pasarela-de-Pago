<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApoderadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('Apoderado', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres');
            $table->string('apellidoP');
            $table->string('apellidoM');
            $table->string('dni')->unique();
            $table->unsignedInteger('alumno_id');
            $table->foreign('alumno_id')->references('id')->on('Alumno');
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
        Schema::dropIfExists('_apoderado');
    }
}
