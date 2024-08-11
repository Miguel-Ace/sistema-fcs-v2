@vite(['resources/js/catalogo/banco.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Centros educativos</p>

        <a href="{{url('/centros_educativos')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/centros_educativos'.'/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="centro_educativo" class="encabezado-input">Centro educativo</label>
                    <input type="text" class="input" name="centro_educativo" id="centro_educativo" value="{{$dato->centro_educativo}}">
                </div>
            </div>

            <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
        </form>
    </div>
@endsection