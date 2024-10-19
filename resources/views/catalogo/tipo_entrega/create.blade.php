@vite(['resources/js/catalogo/tipo_entrega.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Tipos de entregas</p>

        <a href="{{url('/tipos_de_entregas')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/tipos_de_entregas')}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="tipo_entrega" class="encabezado-input">Tipo de entrega</label>
                    <input type="text" class="input @error('tipo_entrega') error @enderror" name="tipo_entrega" id="tipo_entrega">
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
</div>
@endsection