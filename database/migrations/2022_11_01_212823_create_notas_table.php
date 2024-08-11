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
        Schema::create('notas', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->bigInteger('id_expediente')->unsigned()->nullable();
            $table->string('promedio')->nullable();
            $table->string('fecha')->nullable();
            $table->bigInteger('id_grado_escolar')->unsigned()->nullable();
            $table->bigInteger('id_ocupa_tutoria')->unsigned()->nullable();
            $table->string('tipo_promedio')->nullable();
            $table->bigInteger('id_semaforo')->unsigned()->nullable();
            $table->string('observaciones')->nullable()->nullable();
            $table->timestamps();

            $table->foreign('id_expediente')->references('id')->on('expedientes');
            $table->foreign('id_grado_escolar')->references('id')->on('grados_escolares');
            $table->foreign('id_ocupa_tutoria')->references('id')->on('ocupa_tutorias');
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
        Schema::dropIfExists('notas');
    }
};
