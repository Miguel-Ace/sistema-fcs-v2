@vite(['resources/js/catalogo/insumo.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Insumos</p>
        
        <a href="{{url('/insumos')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Insumo:</p>
                    <p class="valor">{{$dato->insumo}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection