@vite(['resources/js/catalogo/baja_padrino.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Bajas de padrinos</p>

        <a href="{{url('/bajas_de_padrinos')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/bajas_de_padrinos')}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="id_padrino" class="encabezado-input">Padrino</label>
                    <select class="input @error('id_padrino') error @enderror" name="id_padrino" id="id_padrino">
                        @foreach ($padrinos as $padrino)
                            <option value="{{$padrino->id}}" {{ old('id_padrino') == $padrino->id ? 'selected' : '' }}>
                                {{$padrino->nombre}} {{$padrino->apellido}}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="id_expediente" class="encabezado-input">Expediente</label>
                    <select class="input @error('id_expediente') error @enderror" name="id_expediente" id="id_expediente">
                        @foreach ($expedientes as $expediente)
                            <option value="{{$expediente->id}}" {{ old('id_expediente') == $expediente->id ? 'selected' : '' }}>
                                {{$expediente->nombre1}} {{$expediente->apellido1}}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="fecha_baja" class="encabezado-input">Fecha de Baja</label>
                    <input type="date" class="input @error('fecha_baja') error @enderror" name="fecha_baja" id="fecha_baja" value="{{ old('fecha_baja') }}">
                </div>
                
                <div class="inputs">
                    <label for="detalle_salida" class="encabezado-input">Detalle de Salida</label>
                    <input type="text" class="input @error('detalle_salida') error @enderror" name="detalle_salida" id="detalle_salida" value="{{ old('detalle_salida') }}">
                </div>
                
                <div class="inputs">
                    <label for="id_motivo_baja" class="encabezado-input">Motivo de Baja</label>
                    <select class="input @error('id_motivo_baja') error @enderror" name="id_motivo_baja" id="id_motivo_baja">
                        @foreach ($motivo_bajas as $motivo)
                            <option value="{{$motivo->id}}" {{ old('id_motivo_baja') == $motivo->id ? 'selected' : '' }}>
                                {{$motivo->motivo_baja}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
</div>
@endsection