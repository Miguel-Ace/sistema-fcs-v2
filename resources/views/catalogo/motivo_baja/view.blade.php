@vite(['resources/js/catalogo/motivo_baja.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Motivos de bajas</p>
        
        <a href="{{url('/motivos_de_bajas')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Motivo de baja:</p>
                    <p class="valor">{{$dato->motivo_baja}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection