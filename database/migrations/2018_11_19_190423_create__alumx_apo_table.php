<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumxApoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumxapo', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('alumno_id');
            $table->unsignedInteger('apoderado_id');
            $table->timestamps();
            $table->foreign('apoderado_id')->references('id')->on('Apoderado');
            $table->foreign('alumno_id')->references('id')->on('alumno');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_alumx_apo');
    }
}
