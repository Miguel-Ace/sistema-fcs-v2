@vite(['resources/js/catalogo/evaluacion_medica.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo"><a href="{{url('/evaluaciones_medicas')}}">Evaluaciones médicas</a> / Detalle evaluaciones médicas</p>
        
        <a href="{{url('/evaluaciones_medicas/detalle_evaluaciones_medicas/'.$id_em)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Especialidad:</p>
                    <p class="valor">{{ $dato->especialidades->especialidad }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Médico:</p>
                    <p class="valor">{{ $dato->medico }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Diagnóstico:</p>
                    <p class="valor">{{ $dato->diagnostico }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Observación:</p>
                    <p class="valor">{{ $dato->observacion }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Semáforo:</p>
                    <p class="valor">{{ $dato->semaforos->color }}</p> <!-- Ajusta "color" al campo adecuado -->
                </div>
                
                <div class="detalle">
                    <p class="clave">Nombre del Diente:</p>
                    <p class="valor">{{ $dato->nombre_diente }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Descripción:</p>
                    <p class="valor">{{ $dato->descripcion }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Fecha:</p>
                    <p class="valor">{{ $dato->fecha }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection