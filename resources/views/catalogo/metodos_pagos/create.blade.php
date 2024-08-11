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
        <form class="marco" action="{{url('/metodos_de_pagos')}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="metodo_pago" class="encabezado-input">Método de pago</label>
                    <input type="text" class="input @error('metodo_pago') error @enderror" name="metodo_pago" id="metodo_pago">
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
@endsection