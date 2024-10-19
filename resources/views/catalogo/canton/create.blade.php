@vite(['resources/js/catalogo/canton.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Cantones</p>

        <a href="{{url('/cantones')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/cantones')}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="canton" class="encabezado-input">Cantón</label>
                    <input type="text" class="input @error('canton') error @enderror" name="canton" id="canton" value="{{ old('canton') }}">
                </div>
                
                <div class="inputs">
                    <label for="id_provincia" class="encabezado-input">Provincia</label>
                    <select class="input @error('id_provincia') error @enderror" name="id_provincia" id="id_provincia">
                        @foreach ($provincias as $provincia)
                            <option value="{{$provincia->id}}" {{ old('id_provincia') == $provincia->id ? 'selected' : '' }}>{{$provincia->provincia}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
</div>
@endsection