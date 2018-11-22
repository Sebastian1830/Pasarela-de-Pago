<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('Cuota', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fechaIni');
            $table->date('fechaFin');
            $table->string('detalle');
            $table->unsignedInteger('mesCuota_id');
            $table->enum('moneda',['SOL','DOL']);
            $table->decimal('monto',6,2);
            $table->foreign('mesCuota_id')->references('id')->on('mesCuota');
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
        Schema::dropIfExists('_cuotas');
    }
}
