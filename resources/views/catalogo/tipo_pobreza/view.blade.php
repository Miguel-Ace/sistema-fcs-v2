@vite(['resources/js/catalogo/tipo_pobreza.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Tipos de pobrezas</p>
        
        <a href="{{url('/tipos_de_pobrezas')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Tipo pobreza:</p>
                    <p class="valor">{{$dato->tipo_pobreza}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection