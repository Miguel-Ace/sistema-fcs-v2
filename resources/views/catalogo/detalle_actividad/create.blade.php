@vite(['resources/js/catalogo/evaluacion_medica.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo"><a href="{{url('/actividades')}}">Actividades</a> / Detalle actividades</p>

        <a href="{{url('/actividades/detalles_actividades/'.$id_a)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <table class="marco">
            <thead>
                <tr class="buscador">
                    <td>
                        <form action="{{url('/expedientes/buscador')}}" method="get">
                            <input type="text" name="buscar" placeholder="Buscar...">
                            <button type="submit" aria-label="Buscar">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>Expediente</td>
                    <td>Edad</td>
                    <td>Agregar</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>{{$dato['niño']}}</td>
                        <td>{{$dato['edad']}}</td>
                        <td class="add-nino {{$dato['activo'] ? 'activo': ''}}">
                            <form action="{{url('/actividades/detalles_actividades/'.$id_a.'/'.$dato['id'].'/'.$dato['activo'])}}"  method="post" enctype="multipart/form-data">
                                @csrf
                                <button><i class="{{$dato['activo'] ? 'fa-solid fa-check' : 'fa-solid fa-plus'}}"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="paginador">{{ $expedientes->links() }}</div>
    </div>
@endsection