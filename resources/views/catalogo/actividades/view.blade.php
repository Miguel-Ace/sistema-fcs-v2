@vite(['resources/js/catalogo/actividad.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Actividades</p>

        <a href="{{url('/actividades')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Actividad:</p>
                    <p class="valor">{{$dato->actividad}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Fecha de Creación:</p>
                    <p class="valor">{{$dato->fecha_creacion}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Fecha de Actividad:</p>
                    <p class="valor">{{$dato->fecha_actividad}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Tipo de Asistencia:</p>
                    <p class="valor">{{$dato->tipo_asistencias->tipo_asistencia}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Patrocinador:</p>
                    <p class="valor">{{$dato->patrocinador}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Proyecto:</p>
                    <p class="valor">{{$dato->proyectos->proyecto}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Cantidad Total de Invitados:</p>
                    <p class="valor">{{$dato->cantidad_total_invitados}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Cantidad Asistidos:</p>
                    <p class="valor">{{$dato->cantidad_asistidos ?? '-'}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Cantidad Ausentes:</p>
                    <p class="valor">{{$dato->cantidad_ausentes ?? '-'}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Observación:</p>
                    <p class="valor">{{$dato->observacion ?? '-'}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection