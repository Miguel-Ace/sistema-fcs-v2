@vite(['resources/js/catalogo/evaluacion_medica.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo"><a href="{{url('/actividades')}}">Actividades</a> / Detalle actividades</p>
        @role('admin|creador')
        @if ($hay_cupos)
            <a href="{{url('/actividades/detalles_actividades/create/'.$id_a)}}" class="btn-cambio-vista btn">
                <i class="fa-solid fa-plus"></i>
                Crear Nuevo
            </a>
        @endif
        @endrole
    </div>

    <div class="datos-mostrar">
        <table class="marco">
            <thead>
                <tr>
                    <td>-</td>
                    <td>Actividad</td>
                    <td>Expediente</td>
                    <td>Asistencia</td>
                    <td>Semáforo</td>
                    <td>Observación</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @role('admin|editor')
                            <a href="{{url('/actividades/detalles_actividades/delete/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-trash"></i></a>
                            <a href="{{url('/actividades/detalles_actividades/'.$id_a.'/'.'edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endrole
                            <a href="{{url('/actividades/detalles_actividades/view/'.$dato->id.'/'.$id_a)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td>{{$dato->actividades->actividad}}</td>
                        <td>{{$dato->expedientes->nombre1}} {{$dato->expedientes->nombre2}} {{$dato->expedientes->apellido1}} {{$dato->expedientes->apellido2}}</td>
                        <td class="acciones-rapidas">
                            <form action="{{url('/actividades/detalles_actividades'.'/'.$dato->id.'/'.$id_a)}}" method="post" class="form-activo">
                                @csrf
                                @method('patch')
                                <button type="submit" class="{{$dato->asistencia == 'Si' ? 'activo' : ''}}" name="asistencia" value="{{ $dato->asistencia }}">{{$dato->asistencia == 'Si'? 'Si' : 'No'}}</button>
                            </form>
                        </td>
                        <td>{{$dato->semaforos->semaforo}}</td>
                        <td>{{$dato->observacion ?? '-'}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="paginador">{{ $datos->links() }}</div>
    </div>
</div>
@endsection