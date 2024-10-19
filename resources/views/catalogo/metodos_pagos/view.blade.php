@vite(['resources/js/catalogo/metodo_pago.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Métodos de pagos</p>
        
        <a href="{{url('/metodos_de_pagos')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Método de pago:</p>
                    <p class="valor">{{$dato->metodo_pago}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection