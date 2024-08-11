@vite(['resources/js/catalogo/metodo_pago.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Métodos de pagos</p>

        <a href="{{url('/metodos_de_pagos')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/metodos_de_pagos'.'/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="metodo_pago" class="encabezado-input">Método de pago</label>
                    <input type="text" class="input" name="metodo_pago" id="metodo_pago" value="{{$dato->metodo_pago}}">
                </div>
            </div>

            <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
        </form>
    </div>
@endsection