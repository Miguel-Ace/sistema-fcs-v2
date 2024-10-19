@vite(['resources/js/catalogo/tipo_asistencia.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Tipos de asistencias</p>

        <a href="{{url('/tipos_de_asistencias')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/tipos_de_asistencias')}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="tipo_asistencia" class="encabezado-input">Tipo asistencia</label>
                    <input type="text" class="input @error('tipo_asistencia') error @enderror" name="tipo_asistencia" id="tipo_asistencia">
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
</div>
@endsection