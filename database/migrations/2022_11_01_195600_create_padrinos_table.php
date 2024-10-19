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
        Schema::create('padrinos', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->string('correo')->nullable();
            $table->string('tipo')->nullable();
            $table->string('fecha_inicio')->nullable();
            $table->string('fecha_final')->nullable();
            $table->string('fecha_nacimiento')->nullable();
            $table->string('mes_nacimiento')->nullable();
            $table->bigInteger('id_provincia')->unsigned()->nullable();
            $table->bigInteger('id_canton')->unsigned()->nullable();
            $table->bigInteger('id_barrio')->unsigned()->nullable();
            $table->bigInteger('id_metodo_pago')->unsigned()->nullable();
            $table->bigInteger('id_banco')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('id_provincia')->references('id')->on('provincias');
            $table->foreign('id_canton')->references('id')->on('cantones');
            $table->foreign('id_barrio')->references('id')->on('barrios');
            $table->foreign('id_metodo_pago')->references('id')->on('metodos_pagos');
            $table->foreign('id_banco')->references('id')->on('bancos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('padrinos');
    }
};
