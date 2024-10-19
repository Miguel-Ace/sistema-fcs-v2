@vite(['resources/js/catalogo/evaluacion_medica.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo"><a href="{{url('/entregas_mensuales')}}">Entregas mensuales</a> / Detalle actividades</p>

        <a href="{{url('/entregas_mensuales/detalle_entregas_mensuales/'.$id_em)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Expediente:</p>
                    <p class="valor">{{$dato->expedientes->nombre1}} {{$dato->expedientes->nombre2}} {{$dato->expedientes->apellido1}} {{$dato->expedientes->apellido2}}</p>
                </div>

                <div class="detalle">
                    <p class="clave">Tipo de entrega:</p>
                    <p class="valor">{{$dato->tipoEntregas->tipo_entrega}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection