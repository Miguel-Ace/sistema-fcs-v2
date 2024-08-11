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
        Schema::create('bajas_padrinos', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->bigInteger('id_padrino')->unsigned()->nullable();
            $table->bigInteger('id_expediente')->unsigned()->nullable();
            $table->string('fecha_baja')->nullable();
            $table->text('detalle_salida')->nullable();
            $table->bigInteger('id_motivo_baja')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('id_padrino')->references('id')->on('padrinos');
            $table->foreign('id_expediente')->references('id')->on('expedientes');
            $table->foreign('id_motivo_baja')->references('id')->on('motivo_bajas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bajas_padrinos');
    }
};
