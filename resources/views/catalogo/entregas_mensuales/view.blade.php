@vite(['resources/js/catalogo/entrega_mensual.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Entregas mensuales</p>
        
        <a href="{{url('/entregas_mensuales')}}" class="btn-cambio-vista btn">
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
                    <p class="clave">Edad:</p>
                    <p class="valor">{{$edad[0]}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Padrino:</p>
                    <p class="valor">{{$dato->padrinos->nombre}} {{$dato->padrinos->apellido}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Insumos:</p>
                    <p class="valor">{{$dato->insumos->insumo}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Fecha:</p>
                    <p class="valor">{{$dato->fecha}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Observaciones:</p>
                    <p class="valor">{{$dato->observaciones}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection