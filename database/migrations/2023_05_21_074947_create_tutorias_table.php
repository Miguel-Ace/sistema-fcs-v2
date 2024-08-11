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
        Schema::create('tutorias', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->bigInteger('id_tutor')->unsigned();
            $table->bigInteger('id_expediente')->unsigned();
            $table->bigInteger('id_comunidad')->unsigned();
            $table->string('promedio')->nullable(); // Obtener el promedio
            $table->string('nota')->nullable(); // Comentario
            $table->bigInteger('id_semaforo')->unsigned();
            $table->timestamps();
            
            $table->foreign('id_tutor')->references('id')->on('tutores');
            $table->foreign('id_expediente')->references('id')->on('expedientes');
            $table->foreign('id_comunidad')->references('id')->on('comunidads');
            // $table->foreign('id_notas')->references('id')->on('notas');
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
        Schema::dropIfExists('tutorias');
    }
};
