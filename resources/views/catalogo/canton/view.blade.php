@vite(['resources/js/catalogo/canton.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Cantones</p>
        
        <a href="{{url('/cantones')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Cantón:</p>
                    <p class="valor">{{$dato->canton}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Provincia:</p>
                    <p class="valor">{{$dato->provincias->provincia}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection