@vite(['resources/js/catalogo/provincia.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Provincias</p>

        <a href="{{url('/provincias')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/provincias')}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="provincia" class="encabezado-input">Provincia</label>
                    <input type="text" class="input @error('provincia') error @enderror" name="provincia" id="provincia">
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
</div>
@endsection