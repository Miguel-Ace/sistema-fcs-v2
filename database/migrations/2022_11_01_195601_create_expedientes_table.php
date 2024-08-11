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
        Schema::create('expedientes', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->bigInteger('id_comunidad')->unsigned()->nullable();
            $table->string('codigo_nino')->nullable();
            $table->string('nombre1')->nullable();
            $table->string('nombre2')->nullable();
            $table->string('apellido1')->nullable();
            $table->string('apellido2')->nullable();
            $table->string('pp')->nullable();
            $table->bigInteger('id_estado')->unsigned()->nullable();
            $table->bigInteger('id_sexo')->unsigned()->nullable();
            $table->string('cedula')->nullable();
            $table->bigInteger('id_tipo_pobreza')->unsigned()->nullable();
            $table->bigInteger('id_barrio')->unsigned()->nullable();
            $table->string('fecha_nacimiento')->nullable();
            $table->string('contacto_representante')->nullable();
            $table->bigInteger('id_grado_escolar')->unsigned()->nullable();
            $table->string('talla_pantalon')->nullable();
            $table->string('talla_camisa')->nullable();
            $table->string('talla_zapato')->nullable();
            $table->bigInteger('id_activo')->unsigned()->nullable();
            $table->string('nombre_encargado')->nullable();
            $table->string('telefono_encargado')->nullable();
            $table->bigInteger('id_centro_educativo')->unsigned()->nullable();
            $table->bigInteger('id_padrino')->unsigned()->nullable();
            $table->bigInteger('id_beca')->unsigned()->nullable();
            $table->timestamps();


            $table->foreign('id_beca')->references('id')->on('becas');
            $table->foreign('id_activo')->references('id')->on('activos');
            $table->foreign('id_sexo')->references('id')->on('sexos');
            $table->foreign('id_comunidad')->references('id')->on('comunidads');
            $table->foreign('id_estado')->references('id')->on('estados');
            $table->foreign('id_tipo_pobreza')->references('id')->on('tipo_pobrezas');
            $table->foreign('id_barrio')->references('id')->on('barrios');
            $table->foreign('id_grado_escolar')->references('id')->on('grados_escolares');
            $table->foreign('id_centro_educativo')->references('id')->on('centro_educativos');
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
        Schema::dropIfExists('expedientes');
    }
};
