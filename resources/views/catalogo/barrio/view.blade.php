@vite(['resources/js/catalogo/barrio.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Barrios</p>
        
        <a href="{{url('/barrios')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Barrio:</p>
                    <p class="valor">{{$dato->barrio}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Cantón:</p>
                    <p class="valor">{{$dato->cantones->canton}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection