@vite(['resources/js/catalogo/tipo_entrega.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Tipos de entregas</p>
        
        <a href="{{url('/tipos_de_entregas')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Tipo de entrega:</p>
                    <p class="valor">{{$dato->tipo_entrega}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection