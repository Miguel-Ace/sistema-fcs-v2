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
        Schema::create('cumpleanios', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->bigInteger('id_padrino')->unsigned()->nullable();
            $table->string('fecha')->nullable();
            $table->string('fecha_entrega_carta')->nullable();
            $table->string('entrega_carta_presentacion')->nullable();
            $table->string('entrega_regalo')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('regalo')->nullable();
            $table->timestamps();

            $table->foreign('id_padrino')->references('id')->on('padrinos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cumpleanios');
    }
};
