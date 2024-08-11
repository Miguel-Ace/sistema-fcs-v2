@vite(['resources/js/catalogo/proyectos.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Proyectos</p>
        
        <a href="{{url('/proyectos')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Proyecto:</p>
                    <p class="valor">{{$dato->proyecto}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection