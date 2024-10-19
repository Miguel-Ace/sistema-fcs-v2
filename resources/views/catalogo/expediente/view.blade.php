@vite(['resources/js/catalogo/expediente.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Expedientes</p>
        
        <a href="{{url('/expedientes')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <div class="marco detalle-registro">
            <div class="contenedor-detalle-registro">
                <div class="detalle">
                    <p class="clave">Comunidad:</p>
                    <p class="valor">{{$dato->comunidades->comunidad}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Primer Nombre:</p>
                    <p class="valor">{{$dato->nombre1}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Segundo Nombre:</p>
                    <p class="valor">{{$dato->nombre2}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Primer Apellido:</p>
                    <p class="valor">{{$dato->apellido1}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Segundo Apellido:</p>
                    <p class="valor">{{$dato->apellido2}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">PP:</p>
                    <p class="valor">{{$dato->pp}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Estado:</p>
                    <p class="valor">{{$dato->estados->estado}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Sexo:</p>
                    <p class="valor">{{$dato->sexos->sexo}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Cédula:</p>
                    <p class="valor">{{$dato->cedula}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Tipo de Pobreza:</p>
                    <p class="valor">{{$dato->tipo_pobrezas->tipo_pobreza}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Barrio:</p>
                    <p class="valor">{{$dato->barrios->barrio}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Fecha de Nacimiento:</p>
                    <p class="valor">{{$dato->fecha_nacimiento}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Contacto Representante:</p>
                    <p class="valor">{{$dato->contacto_representante}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Grado Escolar:</p>
                    <p class="valor">{{$dato->grados_escolares->grado_escolar}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Talla Pantalón:</p>
                    <p class="valor">{{$dato->talla_pantalon}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Talla Camisa:</p>
                    <p class="valor">{{$dato->talla_camisa}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Talla Zapato:</p>
                    <p class="valor">{{$dato->talla_zapato}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Activo:</p>
                    <p class="valor">{{$dato->activo}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Nombre Encargado:</p>
                    <p class="valor">{{$dato->nombre_encargado}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Teléfono Encargado:</p>
                    <p class="valor">{{$dato->telefono_encargado}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Centro Educativo:</p>
                    <p class="valor">{{$dato->centro_educativos->centro_educativo}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Padrino:</p>
                    <p class="valor">{{$dato->padrinos->nombre}} {{$dato->padrinos->apellido}}</p>
                </div>
                <div class="detalle">
                    <p class="clave">Beca:</p>
                    <p class="valor">{{$dato->becas->beca}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection