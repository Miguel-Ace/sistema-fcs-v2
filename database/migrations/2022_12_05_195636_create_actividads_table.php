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
        Schema::create('actividads', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->string('actividad');
            $table->string('fecha_creacion');
            $table->string('fecha_actividad');
            $table->bigInteger('id_tipo_asistencia')->unsigned();
            $table->string('patrocinador');
            $table->bigInteger('id_proyecto')->unsigned();
            $table->string('cantidad_total_invitados')->nullable();
            $table->string('cantidad_asistidos')->nullable();
            $table->string('cantidad_ausentes')->nullable();
            $table->string('observacion')->nullable();
            $table->timestamps();

            $table->foreign('id_proyecto')->references('id')->on('proyectos');
            $table->foreign('id_tipo_asistencia')->references('id')->on('tipo_asistencias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividads');
    }
};
