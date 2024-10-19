@vite(['resources/js/catalogo/provincia.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Provincias</p>
        
        <a href="{{url('/provincias')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Provincia:</p>
                    <p class="valor">{{$dato->provincia}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection