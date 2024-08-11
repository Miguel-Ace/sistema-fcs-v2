@vite(['resources/js/catalogo/canton.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Cantones</p>

        <a href="{{url('/cantones')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/cantones'.'/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="contenedor-inputs">                
                <div class="inputs">
                    <label for="canton" class="encabezado-input">Cantón</label>
                    <input type="text" class="input" name="canton" id="canton" value="{{$dato->canton}}">
                </div>

                <div class="inputs">
                    <label for="id_provincia" class="encabezado-input">Cantón</label>
                    <select class="input" name="id_provincia" id="id_provincia">
                        @foreach ($provincias as $provincia)
                            <option value="{{$provincia->id}}" {{ $dato->id_provincia == $provincia->id ? 'selected' : '' }}>{{$provincia->provincia}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
        </form>
    </div>
@endsection