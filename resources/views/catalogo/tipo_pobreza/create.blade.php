@vite(['resources/js/catalogo/tipo_pobreza.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Tipos de pobrezas</p>

        <a href="{{url('/tipos_de_pobrezas')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/tipos_de_pobrezas')}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="tipo_pobreza" class="encabezado-input">Tipo pobreza</label>
                    <input type="text" class="input @error('tipo_pobreza') error @enderror" name="tipo_pobreza" id="tipo_pobreza">
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
@endsection