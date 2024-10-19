@vite(['resources/js/catalogo/banco.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Centros educativos</p>
        
        <a href="{{url('/centros_educativos')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Centro educativo:</p>
                    <p class="valor">{{$dato->centro_educativo}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection