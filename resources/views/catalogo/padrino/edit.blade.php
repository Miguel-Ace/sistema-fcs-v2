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
        <form class="marco" action="{{url('/padrinos'.'/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="id_barrio" class="encabezado-input">Barrio</label>
                    <select class="input" name="id_barrio" id="id_barrio">
                        @foreach ($barrios as $barrio)
                            <option value="{{ $barrio->id }}" {{ $dato->id_barrio == $barrio->id ? 'selected' : '' }}>
                                {{ $barrio->barrio }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="nombre" class="encabezado-input">Nombre</label>
                    <input type="text" class="input" name="nombre" id="nombre" value="{{ $dato->nombre }}">
                </div>
                
                <div class="inputs">
                    <label for="apellido" class="encabezado-input">Apellido</label>
                    <input type="text" class="input" name="apellido" id="apellido" value="{{ $dato->apellido }}">
                </div>
                
                <div class="inputs">
                    <label for="telefono" class="encabezado-input">Teléfono</label>
                    <input type="text" class="input" name="telefono" id="telefono" value="{{ $dato->telefono }}">
                </div>
                
                <div class="inputs">
                    <label for="direccion" class="encabezado-input">Dirección</label>
                    <input type="text" class="input" name="direccion" id="direccion" value="{{ $dato->direccion }}">
                </div>
                
                <div class="inputs">
                    <label for="correo" class="encabezado-input">Correo</label>
                    <input type="email" class="input" name="correo" id="correo" value="{{ $dato->correo }}">
                </div>
                
                <div class="inputs">
                    <label for="tipo" class="encabezado-input">Tipo</label>
                    <input type="text" class="input" name="tipo" id="tipo" value="{{ $dato->tipo }}">
                </div>
                
                <div class="inputs">
                    <label for="fecha_inicio" class="encabezado-input">Fecha de Inicio</label>
                    <input type="date" class="input" name="fecha_inicio" id="fecha_inicio" value="{{ $dato->fecha_inicio }}">
                </div>
                
                <div class="inputs">
                    <label for="fecha_final" class="encabezado-input">Fecha Final</label>
                    <input type="date" class="input" name="fecha_final" id="fecha_final" value="{{ $dato->fecha_final }}">
                </div>
                
                <div class="inputs">
                    <label for="fecha_nacimiento" class="encabezado-input">Fecha de Nacimiento</label>
                    <input type="date" class="input" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ $dato->fecha_nacimiento }}">
                </div>
                
                <div class="inputs">
                    <label for="id_metodo_pago" class="encabezado-input">Método de Pago</label>
                    <select class="input" name="id_metodo_pago" id="id_metodo_pago">
                        @foreach ($metodos_pagos as $metodo_pago)
                            <option value="{{ $metodo_pago->id }}" {{ $dato->id_metodo_pago == $metodo_pago->id ? 'selected' : '' }}>
                                {{ $metodo_pago->metodo_pago }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="id_banco" class="encabezado-input">Banco</label>
                    <select class="input" name="id_banco" id="id_banco">
                        @foreach ($bancos as $banco)
                            <option value="{{ $banco->id }}" {{ $dato->id_banco == $banco->id ? 'selected' : '' }}>
                                {{ $banco->banco }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
        </form>
    </div>
@endsection