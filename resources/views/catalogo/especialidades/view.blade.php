@vite(['resources/js/catalogo/especialidad.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Especialidades</p>
        
        <a href="{{url('/especialidades')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Especialidad:</p>
                    <p class="valor">{{$dato->especialidad}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection