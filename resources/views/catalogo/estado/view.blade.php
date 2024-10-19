@vite(['resources/js/catalogo/estado.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Estados</p>
        
        <a href="{{url('/estados')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Estado:</p>
                    <p class="valor">{{$dato->estado}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection