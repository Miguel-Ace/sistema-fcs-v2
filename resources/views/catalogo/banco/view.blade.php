@vite(['resources/js/catalogo/banco.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Bancos</p>
        
        <a href="{{url('/bancos')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Banco:</p>
                    <p class="valor">{{$dato->banco}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection