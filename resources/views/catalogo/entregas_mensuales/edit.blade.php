@vite(['resources/js/catalogo/entrega_mensual.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Entregas mensuales</p>

        <a href="{{url('/entregas_mensuales')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/entregas_mensuales'.'/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="id_expediente" class="encabezado-input">Expediente</label>
                    <select class="input" name="id_expediente" id="id_expediente">
                        @foreach ($expedientes as $expediente)
                            <option value="{{$expediente->id}}" {{ $dato->id_expediente == $expediente->id ? 'selected' : '' }}>
                                {{$expediente->nombre1}} {{$expediente->nombre2}} {{$expediente->apellido1}} {{$expediente->apellido2}}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="id_padrino" class="encabezado-input">Padrino</label>
                    <select class="input" name="id_padrino" id="id_padrino">
                        @foreach ($padrinos as $padrino)
                            <option value="{{$padrino->id}}" {{ $dato->id_padrino == $padrino->id ? 'selected' : '' }}>
                                {{$padrino->nombre}} {{$padrino->apellido}}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="id_insumos" class="encabezado-input">Insumos</label>
                    <select class="input" name="id_insumos" id="id_insumos">
                        @foreach ($insumos as $insumo)
                            <option value="{{$insumo->id}}" {{ $dato->id_insumos == $insumo->id ? 'selected' : '' }}>
                                {{$insumo->insumo}}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="fecha" class="encabezado-input">Fecha</label>
                    <input type="date" class="input" name="fecha" id="fecha" value="{{$dato->fecha}}">
                </div>
                
                <div class="inputs">
                    <label for="observaciones" class="encabezado-input">Observaciones</label>
                    <input type="text" class="input" name="observaciones" id="observaciones" value="{{$dato->observaciones}}">
                </div>
            </div>

            <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
        </form>
    </div>
</div>
@endsection