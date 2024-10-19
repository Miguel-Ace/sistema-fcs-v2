@vite(['resources/js/catalogo/padrino.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Padrinos</p>
        
        <a href="{{url('/padrinos')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Provincia:</p>
                    <p class="valor">{{ $dato->provincias->provincia }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Cantón:</p>
                    <p class="valor">{{ $dato->cantones->canton }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Barrio:</p>
                    <p class="valor">{{ $dato->barrios->barrio }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Nombre:</p>
                    <p class="valor">{{ $dato->nombre }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Apellido:</p>
                    <p class="valor">{{ $dato->apellido }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Teléfono:</p>
                    <p class="valor">{{ $dato->telefono }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Dirección:</p>
                    <p class="valor">{{ $dato->direccion }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Correo:</p>
                    <p class="valor">{{ $dato->correo }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Tipo:</p>
                    <p class="valor">{{ $dato->tipo }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Fecha de Inicio:</p>
                    <p class="valor">{{ $dato->fecha_inicio }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Fecha Final:</p>
                    <p class="valor">{{ $dato->fecha_final }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Fecha de Nacimiento:</p>
                    <p class="valor">{{ $dato->fecha_nacimiento }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Método de Pago:</p>
                    <p class="valor">{{ $dato->metodos_pagos->metodo_pago }}</p>
                </div>
                
                <div class="detalle">
                    <p class="clave">Banco:</p>
                    <p class="valor">{{ $dato->bancos->banco }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection