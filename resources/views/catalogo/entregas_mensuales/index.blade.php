@vite(['resources/js/catalogo/entrega_mensual.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Entregas mensuales</p>
        @role('admin|creador')
        <a href="{{url('/entregas_mensuales/create')}}" class="btn-cambio-vista btn">
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
                        <form action="{{url('/entregas_mensuales/buscador')}}" method="get">
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
                    <td>Edad</td>
                    <td>Padrino</td>
                    <td>Insumos</td>
                    <td>Fecha</td>
                    <td>Observaciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $key => $dato)
                    <tr>
                        <td>
                            <a href="{{url('/entregas_mensuales/detalle_entregas_mensuales/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-gifts"></i></a>
                            @role('admin|editor')
                            <a href="{{url('/entregas_mensuales/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endrole
                            <a href="{{url('/entregas_mensuales/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td>{{$dato->expedientes->nombre1}} {{$dato->expedientes->nombre2}} {{$dato->expedientes->apellido1}} {{$dato->expedientes->apellido2}}</td>
                        <td>{{$edades[$key]}}</td>
                        <td>{{$dato->padrinos->nombre}} {{$dato->padrinos->apellido}}</td>
                        <td>{{$dato->insumos->insumo}}</td>
                        <td>{{$dato->fecha}}</td>
                        <td>{{$dato->observaciones ?? '-'}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="paginador">{{ $datos->links() }}</div>
    </div>
@endsection