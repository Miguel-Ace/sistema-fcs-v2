<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enfermedads', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_evaluacion_medica')->unsigned()->nullable();
            $table->bigInteger('id_expediente')->unsigned();
            $table->string('enfermedad');
            $table->string('medicamento');
            $table->timestamps();

            $table->foreign('id_evaluacion_medica')->references('id')->on('evaluaciones_medicas');
            $table->foreign('id_expediente')->references('id')->on('expedientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enfermedads');
    }
};
