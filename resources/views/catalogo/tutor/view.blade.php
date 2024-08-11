@vite(['resources/js/catalogo/tutor.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Tutores</p>
        
        <a href="{{url('/tutores')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Tutor:</p>
                    <p class="valor">{{$dato->tutor}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection