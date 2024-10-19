@vite(['resources/js/catalogo/evaluacion_medica.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo"><a href="{{url('/evaluaciones_medicas')}}">Evaluaciones médicas</a> / Enfermedades</p>
        
        <a href="{{url('/evaluaciones_medicas/enfermedades/'.$id_em)}}" class="btn-cambio-vista btn">
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
                    <p class="clave">Enfermedad:</p>
                    <p class="valor">{{$dato->enfermedad}}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Medicamento:</p>
                    <p class="valor">{{$dato->medicamento}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection