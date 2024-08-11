@vite(['resources/js/catalogo/actividad.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Actividades</p>
        @role('admin|creador')
        <a href="{{url('/actividades/create')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-plus"></i>
            Crear Nuevo
        </a>
        @endrole
    </div>

    <div class="datos-mostrar">
        <table class="marco">
            <thead>
                <tr class="buscador">
                    <td>
                        <form action="{{url('/actividades/buscador')}}" method="get">
                            <input type="text" name="buscar" placeholder="Buscar...">
                            <button type="submit" aria-label="Buscar">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>-</td>
                    <td>Actividad</td>
                    <td>Proyecto</td>
                    <td>Fecha de Creación</td>
                    <td>Fecha de Actividad</td>
                    <td>Cantidad Total de Invitados</td>
                    <td>Cantidad Asistidos</td>
                    <td>Cantidad Ausentes</td>
                    <td>Tipo de Asistencia</td>
                    <td>Patrocinador</td>
                    <td>Observación</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            <a href="{{url('/actividades/detalles_actividades/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-dice"></i></a>
                            @role('admin|editor')
                            <a href="{{url('/actividades/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endrole
                            <a href="{{url('/actividades/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td>{{$dato->actividad}}</td>
                        <td>{{$dato->proyectos->proyecto}}</td>
                        <td>{{$dato->fecha_creacion}}</td>
                        <td>{{$dato->fecha_actividad}}</td>
                        <td>{{$dato->cantidad_total_invitados}}</td>
                        <td>{{$dato->cantidad_asistidos ?? '-'}}</td>
                        <td>{{$dato->cantidad_ausentes ?? '-'}}</td>
                        <td>{{$dato->tipo_asistencias->tipo_asistencia}}</td>
                        <td>{{$dato->patrocinador}}</td>
                        <td>{{$dato->observacion ?? '-'}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="paginador">{{ $datos->links() }}</div>
    </div>
@endsection