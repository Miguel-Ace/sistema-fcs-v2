@vite(['resources/js/catalogo/cumple.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Cumpleaños</p>

        <a href="{{url('/cumpleaños')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/cumpleaños')}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="id_padrino" class="encabezado-input">Padrino</label>
                    <select class="input @error('id_padrino') error @enderror" name="id_padrino" id="id_padrino">
                        @foreach ($padrinos as $padrino)
                            <option value="{{$padrino->id}}" {{ old('id_padrino') == $padrino->id ? 'selected' : '' }}>{{$padrino->nombre}} {{$padrino->apellido}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="fecha" class="encabezado-input">Fecha</label>
                    <input type="date" class="input @error('fecha') error @enderror" name="fecha" id="fecha" value="{{ old('fecha') }}">
                </div>
                
                <div class="inputs">
                    <label for="fecha_entrega_carta" class="encabezado-input">Fecha de Entrega de Carta</label>
                    <input type="date" class="input @error('fecha_entrega_carta') error @enderror" name="fecha_entrega_carta" id="fecha_entrega_carta" value="{{ old('fecha_entrega_carta') }}">
                </div>
                
                <div class="inputs">
                    <label for="entrega_carta_presentacion" class="encabezado-input">Entrega de Carta de Presentación</label>
                    <input type="date" class="input @error('entrega_carta_presentacion') error @enderror" name="entrega_carta_presentacion" id="entrega_carta_presentacion" value="{{ old('entrega_carta_presentacion') }}">
                </div>
                
                <div class="inputs">
                    <label for="entrega_regalo" class="encabezado-input">Entrega de Regalo</label>
                    <input type="date" class="input @error('entrega_regalo') error @enderror" name="entrega_regalo" id="entrega_regalo" value="{{ old('entrega_regalo') }}">
                </div>
                
                <div class="inputs">
                    <label for="observaciones" class="encabezado-input">Observaciones</label>
                    <input type="text" class="input @error('observaciones') error @enderror" name="observaciones" id="observaciones" value="{{ old('observaciones') }}">
                </div>
                
                <div class="inputs">
                    <label for="regalo" class="encabezado-input">Regalo</label>
                    <input type="text" class="input @error('regalo') error @enderror" name="regalo" id="regalo" value="{{ old('regalo') }}">
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
</div>
@endsection