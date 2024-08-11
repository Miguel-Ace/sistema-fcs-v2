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
        Schema::create('detalle_actividads', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->bigInteger('id_actividad')->unsigned()->nullable();
            $table->bigInteger('id_expediente')->unsigned();
            $table->string('asistencia');
            $table->string('observacion')->nullable();
            $table->bigInteger('id_semaforo')->unsigned();
            $table->timestamps();

            $table->foreign('id_actividad')->references('id')->on('actividads');
            $table->foreign('id_expediente')->references('id')->on('expedientes');
            $table->foreign('id_semaforo')->references('id')->on('semaforos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_actividads');
    }
};
