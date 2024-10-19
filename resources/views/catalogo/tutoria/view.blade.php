@vite(['resources/js/catalogo/tutoria.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Tutorias</p>

        <a href="{{url('/tutorias')}}" class="btn-cambio-vista btn">
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
                    <p class="clave">Tutor:</p>
                    <p class="valor">{{$dato->tutores->tutor}}</p>
                </div>

                <div class="detalle">
                    <p class="clave">Comunidad:</p>
                    <p class="valor">{{$dato->comunidades->comunidad}}</p>
                </div>

                <div class="detalle">
                    <p class="clave">Promedio:</p>
                    <p class="valor">{{$dato->promedio ?? 'No tiene promedio'}}</p>
                </div>

                <div class="detalle">
                    <p class="clave">Semaforo:</p>
                    <p class="valor">{{$dato->semaforos->semaforo}}</p>
                </div>

                <div class="detalle">
                    <p class="clave">Observaciones:</p>
                    <p class="valor">{{$dato->nota ?? '-'}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection