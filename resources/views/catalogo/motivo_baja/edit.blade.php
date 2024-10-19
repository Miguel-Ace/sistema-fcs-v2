@vite(['resources/js/catalogo/motivo_baja.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Motivos de bajas</p>

        <a href="{{url('/motivos_de_bajas')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/motivos_de_bajas'.'/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="motivo_baja" class="encabezado-input">Motivo de baja</label>
                    <input type="text" class="input" name="motivo_baja" id="motivo_baja" value="{{$dato->motivo_baja}}">
                </div>
            </div>

            <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
        </form>
    </div>
</div>
@endsection