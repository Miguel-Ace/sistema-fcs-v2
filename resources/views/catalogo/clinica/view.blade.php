@vite(['resources/js/catalogo/clinica.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Clínicas</p>
        
        <a href="{{url('/clinicas')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Clínica:</p>
                    <p class="valor">{{$dato->clinica}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection