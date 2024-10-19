@vite(['resources/js/catalogo/barrio.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Barrios</p>

        <a href="{{url('/barrios')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/barrios'.'/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="contenedor-inputs">                
                <div class="inputs">
                    <label for="barrio" class="encabezado-input">Barrio</label>
                    <input type="text" class="input" name="barrio" id="barrio" value="{{$dato->barrio}}">
                </div>

                <div class="inputs">
                    <label for="id_canton" class="encabezado-input">Cantón</label>
                    <select class="input" name="id_canton" id="id_canton">
                        @foreach ($cantones as $canton)
                            <option value="{{$canton->id}}" {{ $dato->id_canton == $canton->id ? 'selected' : '' }}>{{$canton->canton}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
        </form>
    </div>
</div>
@endsection