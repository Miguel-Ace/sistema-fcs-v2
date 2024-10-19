@vite(['resources/js/catalogo/grado_escolar.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Grados escolares</p>
        
        <a href="{{url('/grados_escolares')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Grado escolar:</p>
                    <p class="valor">{{$dato->grado_escolar}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection