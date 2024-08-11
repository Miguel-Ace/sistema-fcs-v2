@vite(['resources/js/catalogo/evaluacion_medica.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Evaluaciones médicas</p>

        <a href="{{url('/evaluaciones_medicas')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/evaluaciones_medicas')}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="id_expediente" class="encabezado-input">Expediente</label>
                    <select class="input @error('id_expediente') error @enderror" name="id_expediente" id="id_expediente">
                        @foreach ($expedientes as $expediente)
                            <option value="{{$expediente->id}}" {{ old('id_expediente') == $expediente->id ? 'selected' : '' }}>{{$expediente->nombre1}} {{$expediente->nombre2}} {{$expediente->apellido1}} {{$expediente->apellido2}}</option> <!-- Ajusta "nombre" al campo adecuado -->
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="id_clinica" class="encabezado-input">Clínica</label>
                    <select class="input @error('id_clinica') error @enderror" name="id_clinica" id="id_clinica">
                        @foreach ($clinicas as $clinica)
                            <option value="{{$clinica->id}}" {{ old('id_clinica') == $clinica->id ? 'selected' : '' }}>{{$clinica->clinica}}</option> <!-- Ajusta "nombre" al campo adecuado -->
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="fecha" class="encabezado-input">Fecha</label>
                    <input type="date" class="input @error('fecha') error @enderror" name="fecha" id="fecha" value="{{ old('fecha') }}">
                </div>
                
                <div class="inputs">
                    <label for="peso" class="encabezado-input">Peso</label>
                    <input type="text" class="input @error('peso') error @enderror" name="peso" id="peso" value="{{ old('peso') }}">
                </div>
                
                <div class="inputs">
                    <label for="talla" class="encabezado-input">Talla</label>
                    <input type="text" class="input @error('talla') error @enderror" name="talla" id="talla" value="{{ old('talla') }}">
                </div>
                
                <div class="inputs">
                    <label for="signos" class="encabezado-input">Signos</label>
                    <input type="text" class="input @error('signos') error @enderror" name="signos" id="signos" value="{{ old('signos') }}">
                </div>
                
                <div class="inputs">
                    <label for="notas" class="encabezado-input">Notas</label>
                    <input type="text" class="input @error('notas') error @enderror" name="notas" id="notas" value="{{ old('notas') }}">
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
@endsection