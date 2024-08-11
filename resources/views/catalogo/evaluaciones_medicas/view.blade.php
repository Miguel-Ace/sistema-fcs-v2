@vite(['resources/js/catalogo/evaluacion_medica.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Evaluaciones médicas</p>
        
        <a href="{{url('/evaluaciones_medicas')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Expediente:</p>
                    <p class="valor">{{ $dato->expedientes->nombre1 }} {{ $dato->expedientes->nombre2 }} {{ $dato->expedientes->apellido1 }} {{ $dato->expedientes->apellido2 }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Clínica:</p>
                    <p class="valor">{{ $dato->clinicas->clinica }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Fecha:</p>
                    <p class="valor">{{ $dato->fecha }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Peso:</p>
                    <p class="valor">{{ $dato->peso }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Talla:</p>
                    <p class="valor">{{ $dato->talla }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Signos:</p>
                    <p class="valor">{{ $dato->signos }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Notas:</p>
                    <p class="valor">{{ $dato->notas }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection