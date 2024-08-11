@vite(['resources/js/catalogo/padrino.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Padrinos</p>

        <a href="{{url('/padrinos')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/padrinos')}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="id_barrio" class="encabezado-input">Barrio</label>
                    <select class="input @error('id_barrio') error @enderror" name="id_barrio" id="id_barrio">
                        @foreach ($barrios as $barrio)
                            <option value="{{ $barrio->id }}" {{ old('id_barrio') == $barrio->id ? 'selected' : '' }}>
                                {{ $barrio->barrio }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="nombre" class="encabezado-input">Nombre</label>
                    <input type="text" class="input @error('nombre') error @enderror" name="nombre" id="nombre" value="{{ old('nombre') }}">
                </div>
                
                <div class="inputs">
                    <label for="apellido" class="encabezado-input">Apellido</label>
                    <input type="text" class="input @error('apellido') error @enderror" name="apellido" id="apellido" value="{{ old('apellido') }}">
                </div>
                
                <div class="inputs">
                    <label for="telefono" class="encabezado-input">Teléfono</label>
                    <input type="text" class="input @error('telefono') error @enderror" name="telefono" id="telefono" value="{{ old('telefono') }}">
                </div>
                
                <div class="inputs">
                    <label for="direccion" class="encabezado-input">Dirección</label>
                    <input type="text" class="input @error('direccion') error @enderror" name="direccion" id="direccion" value="{{ old('direccion') }}">
                </div>
                
                <div class="inputs">
                    <label for="correo" class="encabezado-input">Correo</label>
                    <input type="email" class="input @error('correo') error @enderror" name="correo" id="correo" value="{{ old('correo') }}">
                </div>
                
                <div class="inputs">
                    <label for="tipo" class="encabezado-input">Tipo</label>
                    <input type="text" class="input @error('tipo') error @enderror" name="tipo" id="tipo" value="{{ old('tipo') }}">
                </div>
                
                <div class="inputs">
                    <label for="fecha_inicio" class="encabezado-input">Fecha de Inicio</label>
                    <input type="date" class="input @error('fecha_inicio') error @enderror" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio') }}">
                </div>
                
                <div class="inputs">
                    <label for="fecha_final" class="encabezado-input">Fecha Final</label>
                    <input type="date" class="input @error('fecha_final') error @enderror" name="fecha_final" id="fecha_final" value="{{ old('fecha_final') }}">
                </div>
                
                <div class="inputs">
                    <label for="fecha_nacimiento" class="encabezado-input">Fecha de Nacimiento</label>
                    <input type="date" class="input @error('fecha_nacimiento') error @enderror" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
                </div>
                
                <div class="inputs">
                    <label for="id_metodo_pago" class="encabezado-input">Método de Pago</label>
                    <select class="input @error('id_metodo_pago') error @enderror" name="id_metodo_pago" id="id_metodo_pago">
                        @foreach ($metodos_pagos as $metodo_pago)
                            <option value="{{ $metodo_pago->id }}" {{ old('id_metodo_pago') == $metodo_pago->id ? 'selected' : '' }}>
                                {{ $metodo_pago->metodo_pago}}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="id_banco" class="encabezado-input">Banco</label>
                    <select class="input @error('id_banco') error @enderror" name="id_banco" id="id_banco">
                        @foreach ($bancos as $banco)
                            <option value="{{ $banco->id }}" {{ old('id_banco') == $banco->id ? 'selected' : '' }}>
                                {{ $banco->banco }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
@endsection