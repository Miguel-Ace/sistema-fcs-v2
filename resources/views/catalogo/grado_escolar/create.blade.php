@vite(['resources/js/catalogo/grado_escolar.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Grados escolares</p>

        <a href="{{url('/grados_escolares')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/grados_escolares')}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="grado_escolar" class="encabezado-input">Grado escolar</label>
                    <input type="text" class="input @error('grado_escolar') error @enderror" name="grado_escolar" id="grado_escolar">
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
@endsection