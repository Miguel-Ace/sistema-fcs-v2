@vite(['resources/js/catalogo/evaluacion_medica.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo"><a href="{{url('/evaluaciones_medicas')}}">Evaluaciones médicas</a> / Detalle evaluaciones médicas</p>
        @role('admin|creador')
        <a href="{{url('/evaluaciones_medicas/detalle_evaluaciones_medicas/create/'.$id_em)}}" class="btn-cambio-vista btn">
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
                    <td>Especialidad</td>
                    <td>Médico</td>
                    <td>Diagnóstico</td>
                    <td>Observación</td>
                    <td>Semáforo</td>
                    <td>Nombre del Diente</td>
                    <td>Descripción</td>
                    <td>Fecha</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @role('admin|editor')
                            <a href="{{url('/evaluaciones_medicas/detalle_evaluaciones_medicas/'.$id_em.'/'.'edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endrole
                            <a href="{{url('/evaluaciones_medicas/detalle_evaluaciones_medicas/view/'.$dato->id.'/'.$id_em)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td>{{$dato->especialidades->especialidad}}</td>
                        <td>{{$dato->medico}}</td>
                        <td>{{$dato->diagnostico}}</td>
                        <td>{{$dato->observacion ?? '-'}}</td>
                        <td>{{$dato->semaforos->semaforo}}</td>
                        <td>{{$dato->nombre_diente ?? '-'}}</td>
                        <td>{{$dato->descripcion ?? '-'}}</td>
                        <td>{{$dato->fecha}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="paginador">{{ $datos->links() }}</div>
    </div>
</div>
@endsection