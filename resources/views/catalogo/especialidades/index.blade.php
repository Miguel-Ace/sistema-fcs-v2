@vite(['resources/js/catalogo/especialidad.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Especialidades</p>
        @role('admin|creador')
        <a href="{{url('/especialidades/create')}}" class="btn-cambio-vista btn">
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
                        <form action="{{url('/especialidades/buscador')}}" method="get">
                            <input type="text" name="buscar" placeholder="Buscar...">
                            <button type="submit" aria-label="Buscar">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>-</td>
                    <td>Comunidad</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @role('admin|editor')
                            <a href="{{url('/especialidades/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endrole
                            <a href="{{url('/especialidades/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td>{{$dato->especialidad}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="paginador">{{ $datos->links() }}</div>
    </div>
@endsection