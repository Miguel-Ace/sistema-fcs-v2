@vite(['resources/js/catalogo/barrio.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Barrios</p>

        <a href="{{url('/barrios')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/barrios')}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="barrio" class="encabezado-input">Barrio</label>
                    <input type="text" class="input @error('barrio') error @enderror" name="barrio" id="barrio" value="{{ old('barrio') }}">
                </div>
                
                <div class="inputs">
                    <label for="id_canton" class="encabezado-input">Cantón</label>
                    <select class="input @error('id_canton') error @enderror" name="id_canton" id="id_canton">
                        @foreach ($cantones as $canton)
                            <option value="{{$canton->id}}" {{ old('id_canton') == $canton->id ? 'selected' : '' }}>{{$canton->canton}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
@endsection