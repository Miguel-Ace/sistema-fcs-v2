@vite(['resources/js/catalogo/evaluacion_medica.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Evaluaciones médicas</p>
        @role('admin|creador')
        <a href="{{url('/evaluaciones_medicas/create')}}" class="btn-cambio-vista btn">
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
                        <form action="{{url('/evaluaciones_medicas/buscador')}}" method="get">
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
                    <td>Clínica</td>
                    <td>Fecha</td>
                    <td>Peso</td>
                    <td>Talla</td>
                    <td>Signos</td>
                    <td>Notas</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @role('admin|editor')
                            <a href="{{url('/evaluaciones_medicas/enfermedades/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-file-medical"></i></a>
                            <a href="{{url('/evaluaciones_medicas/detalle_evaluaciones_medicas/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-notes-medical"></i></a>
                            <a href="{{url('/evaluaciones_medicas/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endrole
                            <a href="{{url('/evaluaciones_medicas/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td>{{$dato->expedientes->nombre1}} {{$dato->expedientes->nombre2}} {{$dato->expedientes->apellido1}} {{$dato->expedientes->apellido2}}</td>
                        <td>{{$dato->clinicas->clinica}}</td>
                        <td>{{$dato->fecha}}</td>
                        <td>{{$dato->peso}}</td>
                        <td>{{$dato->talla}}</td>
                        <td>{{$dato->signos}}</td>
                        <td class="text-left">{{$dato->notas}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="paginador">{{ $datos->links() }}</div>
    </div>
@endsection