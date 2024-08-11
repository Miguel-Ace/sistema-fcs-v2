@vite(['resources/js/catalogo/tipo_entrega.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Tipos de entregas</p>

        <a href="{{url('/tipos_de_entregas')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/tipos_de_entregas'.'/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="tipo_entrega" class="encabezado-input">Tipo de entrega</label>
                    <input type="text" class="input" name="tipo_entrega" id="tipo_entrega" value="{{$dato->tipo_entrega}}">
                </div>
            </div>

            <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
        </form>
    </div>
@endsection