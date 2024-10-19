@vite(['resources/js/catalogo/tipo_asistencia.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Tipos de asistencias</p>
        
        <a href="{{url('/tipos_de_asistencias')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Tipo asistencia:</p>
                    <p class="valor">{{$dato->tipo_asistencia}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection