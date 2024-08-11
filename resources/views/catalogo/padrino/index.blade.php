@vite(['resources/js/catalogo/padrino.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Padrinos</p>
        @role('admin|creador')
        <a href="{{url('/padrinos/create')}}" class="btn-cambio-vista btn">
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
                        <form action="{{url('/padrinos/buscador')}}" method="get">
                            <input type="text" name="buscar" placeholder="Buscar...">
                            <button type="submit" aria-label="Buscar">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>-</td>
                    <td>Nombre</td>
                    <td>Teléfono</td>
                    <td>Método de pago</td>
                    <td>Fecha de inicio</td>
                    <td>Fecha final</td>
                    <td>Dirección</td>
                    <td>Correo</td>
                    <td>Tipo</td>
                    <td>Fecha de nacimiento</td>
                    <td>Provincia</td>
                    <td>Cantón</td>
                    <td>Barrio</td>
                    <td>Banco</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @role('admin|editor')
                            <a href="{{url('/padrinos/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endrole
                            <a href="{{url('/padrinos/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td class="text-left">{{ $dato->nombre }} {{ $dato->apellido }}</td>
                        <td>{{ $dato->telefono }}</td>
                        <td>{{ $dato->metodos_pagos->metodo_pago ?? '-' }}</td>
                        <td>{{ $dato->fecha_inicio }}</td>
                        <td>{{ $dato->fecha_final }}</td>
                        <td class="text-left">{{ $dato->direccion }}</td>
                        <td class="text-left">{{ $dato->correo }}</td>
                        <td>{{ $dato->tipo }}</td>
                        <td>{{ $dato->fecha_nacimiento }}</td>
                        <td>{{ $dato->provincias->provincia ?? '-' }}</td>
                        <td>{{ $dato->cantones->canton ?? '-' }}</td>
                        <td>{{ $dato->barrios->barrio ?? '-' }}</td>
                        <td>{{ $dato->bancos->banco ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="paginador">{{ $datos->links() }}</div>
    </div>
@endsection