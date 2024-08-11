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
        Schema::create('evaluaciones_medicas', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->bigInteger('id_expediente')->unsigned();
            $table->bigInteger('id_clinica')->unsigned();
            $table->string('fecha');
            $table->string('peso');
            $table->string('talla');
            $table->string('signos');
            $table->string('notas')->nullable();
            $table->timestamps();

            $table->foreign('id_expediente')->references('id')->on('expedientes');
            $table->foreign('id_clinica')->references('id')->on('clinicas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluaciones_medicas');
    }
};
