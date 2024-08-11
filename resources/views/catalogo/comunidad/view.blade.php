@vite(['resources/js/catalogo/comunidad.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Comunidades</p>
        
        <a href="{{url('/comunidades')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Comunidad:</p>
                    <p class="valor">{{$dato->comunidad}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection