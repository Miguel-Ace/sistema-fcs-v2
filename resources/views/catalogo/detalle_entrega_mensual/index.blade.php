@vite(['resources/js/catalogo/evaluacion_medica.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo"><a href="{{url('/entregas_mensuales')}}">Entregas mensuales</a> / Detalle actividades</p>
        @role('admin|creador')
        <a href="{{url('/entregas_mensuales/detalle_entregas_mensuales/create/'.$id_em)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-plus"></i>
            Crear Nuevo
        </a>
        @endrole
    </div>

    <div class="datos-mostrar">
        <table class="marco">
            <thead>
                <tr>
                    <td>-</td>
                    <td>Expediente</td>
                    <td>Tipo de Entrega</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @role('admin|editor')
                            {{-- <a href="{{url('/entregas_mensuales/detalles_actividades/delete/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-trash"></i></a> --}}
                            <a href="{{url('/entregas_mensuales/detalle_entregas_mensuales/'.$id_em.'/'.'edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endrole
                            <a href="{{url('/entregas_mensuales/detalle_entregas_mensuales/view/'.$dato->id.'/'.$id_em)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td>{{$dato->expedientes->nombre1}} {{$dato->expedientes->nombre2}} {{$dato->expedientes->apellido1}} {{$dato->expedientes->apellido2}}</td>
                        <td>{{$dato->tipoEntregas->tipo_entrega}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="paginador">{{ $datos->links() }}</div>
    </div>
</div>
@endsection