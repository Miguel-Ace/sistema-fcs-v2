@vite(['resources/js/catalogo/notas.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Notas</p>
        @role('admin|creador')
        <a href="{{url('/notas/create')}}" class="btn-cambio-vista btn">
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
                        <form action="{{url('/notas/buscador')}}" method="get">
                            <input type="text" name="buscar" placeholder="Buscar...">
                            <button type="submit" aria-label="Buscar">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>-</td>
                    <td>Expediente</td>
                    <td>Promedio</td>
                    <td>Fecha</td>
                    <td>Grado Escolar</td>
                    <td>Ocupa Tutoría</td>
                    <td>Tipo de Promedio</td>
                    <td>Semáforo</td>
                    <td>Observaciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @role('admin|editor')
                            <a href="{{url('/notas/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endrole
                            <a href="{{url('/notas/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td>{{$dato->expedientes->nombre1}} {{$dato->expedientes->nombre2}} {{$dato->expedientes->apellido1}} {{$dato->expedientes->apellido2}}</td>
                        <td>{{$dato->promedio}}</td>
                        <td>{{$dato->fecha}}</td>
                        <td>{{$dato->grados_escolares->grado_escolar}}</td>
                        <td>{{$dato->ocupa_tutorias->ocupa_tutoria}}</td>
                        <td>{{$dato->tipo_promedio}}</td>
                        <td>{{$dato->semaforos->semaforo}}</td>
                        <td>{{$dato->observaciones ? $dato->observaciones : '-'}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="paginador">{{ $datos->links() }}</div>
    </div>
@endsection