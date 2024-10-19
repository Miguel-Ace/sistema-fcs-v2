@vite(['resources/js/catalogo/cumple.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Cumpleaños</p>
        
        <a href="{{url('/cumpleaños')}}" class="btn-cambio-vista btn">
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
                    <p class="clave">Fecha:</p>
                    <p class="valor">{{$dato->fecha}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Fecha de Entrega de Carta:</p>
                    <p class="valor">{{$dato->fecha_entrega_carta}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Entrega de Carta de Presentación:</p>
                    <p class="valor">{{$dato->entrega_carta_presentacion ? 'Sí' : 'No'}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Entrega de Regalo:</p>
                    <p class="valor">{{$dato->entrega_regalo ? 'Sí' : 'No'}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Observaciones:</p>
                    <p class="valor">{{$dato->observaciones}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Regalo:</p>
                    <p class="valor">{{$dato->regalo}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection