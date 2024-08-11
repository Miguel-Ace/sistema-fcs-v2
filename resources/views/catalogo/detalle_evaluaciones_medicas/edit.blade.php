@vite(['resources/js/catalogo/evaluacion_medica.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo"><a href="{{url('/evaluaciones_medicas')}}">Evaluaciones médicas</a> / Detalle evaluaciones médicas</p>

        <a href="{{url('/evaluaciones_medicas/detalle_evaluaciones_medicas/'.$id_em)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/evaluaciones_medicas/detalle_evaluaciones_medicas/'.$dato->id.'/'.$id_em)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="id_especialidad" class="encabezado-input">Especialidad</label>
                    <select class="input" name="id_especialidad" id="id_especialidad">
                        @foreach ($especialidades as $especialidad)
                            <option value="{{$especialidad->id}}" {{ $dato->id_especialidad == $especialidad->id ? 'selected' : '' }}>{{$especialidad->especialidad}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="medico" class="encabezado-input">Médico</label>
                    <input type="text" class="input" name="medico" id="medico" value="{{$dato->medico}}">
                </div>
                
                <div class="inputs">
                    <label for="diagnostico" class="encabezado-input">Diagnóstico</label>
                    <input type="text" class="input" name="diagnostico" id="diagnostico" value="{{$dato->diagnostico}}">
                </div>
                
                <div class="inputs">
                    <label for="observacion" class="encabezado-input">Observación</label>
                    <input type="text" class="input" name="observacion" id="observacion" value="{{$dato->observacion}}">
                </div>
                
                <div class="inputs">
                    <label for="id_semaforo" class="encabezado-input">Semáforo</label>
                    <select class="input" name="id_semaforo" id="id_semaforo">
                        @foreach ($semaforos as $semaforo)
                            <option value="{{$semaforo->id}}" {{ $dato->id_semaforo == $semaforo->id ? 'selected' : '' }}>{{$semaforo->semaforo}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="nombre_diente" class="encabezado-input">Nombre del Diente</label>
                    <input type="text" class="input" name="nombre_diente" id="nombre_diente" value="{{$dato->nombre_diente}}">
                </div>
                
                <div class="inputs">
                    <label for="descripcion" class="encabezado-input">Descripción</label>
                    <input type="text" class="input" name="descripcion" id="descripcion" value="{{$dato->descripcion}}">
                </div>
                
                <div class="inputs">
                    <label for="fecha" class="encabezado-input">Fecha</label>
                    <input type="date" class="input" name="fecha" id="fecha" value="{{$dato->fecha}}">
                </div>
            </div>

            <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
        </form>
    </div>
@endsection