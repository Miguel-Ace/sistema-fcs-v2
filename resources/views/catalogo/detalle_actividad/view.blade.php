@vite(['resources/js/catalogo/evaluacion_medica.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo"><a href="{{url('/actividades')}}">Actividades</a> / Detalle actividades</p>

        <a href="{{url('/actividades/detalles_actividades/'.$id_a)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Actividad:</p>
                    <p class="valor">{{$dato->actividades->actividad}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Expediente:</p>
                    <p class="valor">{{$dato->expedientes->nombre1}} {{$dato->expedientes->nombre2}} {{$dato->expedientes->apellido1}} {{$dato->expedientes->apellido2}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Asistencia:</p>
                    <p class="valor">{{$dato->asistencia ? 'Presente' : 'Ausente'}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Semáforo:</p>
                    <p class="valor">{{$dato->semaforos->semaforo}}</p>
                </div>

                <div class="detalle">
                    <p class="clave">Observación:</p>
                    <p class="valor">{{$dato->observacion ?? '-'}}</p>
                </div>
                
            </div>
        </div>
    </div>
@endsection