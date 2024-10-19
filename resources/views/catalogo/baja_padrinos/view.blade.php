@vite(['resources/js/catalogo/baja_padrino.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Bajas de padrinos</p>
        
        <a href="{{url('/bajas_de_padrinos')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Padrino:</p>
                    <p class="valor">{{$dato->padrinos->nombre}} {{$dato->padrinos->apellido}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Expediente:</p>
                    <p class="valor">{{$dato->expedientes->nombre1}} {{$dato->expedientes->nombre2}} {{$dato->expedientes->apellido1}} {{$dato->expedientes->apellido2}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Fecha de Baja:</p>
                    <p class="valor">{{$dato->fecha_baja}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Detalle de Salida:</p>
                    <p class="valor">{{$dato->detalle_salida}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Motivo de Baja:</p>
                    <p class="valor">{{$dato->motivo_bajas->motivo_baja}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection