@vite(['resources/js/catalogo/notas.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Notas</p>
        
        <a href="{{url('/notas')}}" class="btn-cambio-vista btn">
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
                    <p class="clave">Promedio Ponderado:</p>
                    <p class="valor">{{$dato->promedio}}</p>
                </div>
                
                {{-- <div class="detalle">
                    <p class="clave">Fecha:</p>
                    <p class="valor">{{$dato->fecha}}</p>
                </div> --}}
                
                <div class="detalle">
                    <p class="clave">Grado Escolar:</p>
                    <p class="valor">{{$dato->grados_escolares->grado_escolar}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Ocupa Tutoría:</p>
                    <p class="valor">{{$dato->ocupa_tutorias->ocupa_tutoria}}</p>
                </div>
                
                {{-- <div class="detalle">
                    <p class="clave">Tipo de Promedio:</p>
                    <p class="valor">{{$dato->tipo_promedio}}</p>
                </div> --}}
                
                <div class="detalle">
                    <p class="clave">Semáforo:</p>
                    <p class="valor">{{$dato->semaforos->semaforo}}</p>
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