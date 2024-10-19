@vite(['resources/js/catalogo/evaluacion_medica.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo"><a href="{{url('/evaluaciones_medicas')}}">Evaluaciones médicas</a> / Detalle evaluaciones médicas</p>

        <a href="{{url('/evaluaciones_medicas/detalle_evaluaciones_medicas/'.$id_em)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/evaluaciones_medicas/detalle_evaluaciones_medicas/'.$id_em)}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="id_especialidad" class="encabezado-input">Especialidad</label>
                    <select class="input @error('id_especialidad') error @enderror" name="id_especialidad" id="id_especialidad">
                        @foreach ($especialidades as $especialidad)
                            <option value="{{$especialidad->id}}" {{ old('id_especialidad') == $especialidad->id ? 'selected' : '' }}>{{$especialidad->especialidad}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="medico" class="encabezado-input">Médico</label>
                    <input type="text" class="input @error('medico') error @enderror" name="medico" id="medico" value="{{ old('medico') }}">
                </div>
                
                <div class="inputs">
                    <label for="diagnostico" class="encabezado-input">Diagnóstico</label>
                    <input type="text" class="input @error('diagnostico') error @enderror" name="diagnostico" id="diagnostico" value="{{ old('diagnostico') }}">
                </div>
                
                <div class="inputs">
                    <label for="observacion" class="encabezado-input">Observación</label>
                    <input type="text" class="input @error('observacion') error @enderror" name="observacion" id="observacion" value="{{ old('observacion') }}">
                </div>
                
                <div class="inputs">
                    <label for="id_semaforo" class="encabezado-input">Semáforo</label>
                    <select class="input @error('id_semaforo') error @enderror" name="id_semaforo" id="id_semaforo">
                        @foreach ($semaforos as $semaforo)
                            <option value="{{$semaforo->id}}" {{ old('id_semaforo') == $semaforo->id ? 'selected' : '' }}>{{$semaforo->semaforo}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="nombre_diente" class="encabezado-input">Nombre del Diente</label>
                    <input type="text" class="input @error('nombre_diente') error @enderror" name="nombre_diente" id="nombre_diente" value="{{ old('nombre_diente') }}">
                </div>
                
                <div class="inputs">
                    <label for="descripcion" class="encabezado-input">Descripción</label>
                    <input type="text" class="input @error('descripcion') error @enderror" name="descripcion" id="descripcion" value="{{ old('descripcion') }}">
                </div>
                
                <div class="inputs">
                    <label for="fecha" class="encabezado-input">Fecha</label>
                    <input type="date" class="input @error('fecha') error @enderror" name="fecha" id="fecha" value="{{ old('fecha') }}">
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
</div>
@endsection