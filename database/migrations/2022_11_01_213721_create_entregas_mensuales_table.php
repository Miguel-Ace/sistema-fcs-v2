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
        Schema::create('entregas_mensuales', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->bigInteger('id_expediente')->unsigned()->nullable();
            $table->bigInteger('id_padrino')->unsigned()->nullable();
            $table->bigInteger('id_insumos')->unsigned()->nullable();
            $table->string('fecha')->nullable();
            $table->string('observaciones')->nullable();
            $table->timestamps();

            $table->foreign('id_expediente')->references('id')->on('expedientes');
            $table->foreign('id_padrino')->references('id')->on('padrinos');
            $table->foreign('id_insumos')->references('id')->on('insumos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entregas_mensuales');
    }
};
