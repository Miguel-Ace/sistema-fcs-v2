@vite(['resources/js/catalogo/actividad.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Actividades</p>

        <a href="{{url('/actividades')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/actividades'.'/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="actividad" class="encabezado-input">Actividad</label>
                    <input type="text" class="input" name="actividad" id="actividad" value="{{$dato->actividad}}">
                </div>
                
                <div class="inputs">
                    <label for="fecha_actividad" class="encabezado-input">Fecha de Actividad</label>
                    <input type="date" class="input" name="fecha_actividad" id="fecha_actividad" value="{{$dato->fecha_actividad}}">
                </div>
                
                <div class="inputs">
                    <label for="id_tipo_asistencia" class="encabezado-input">Tipo de Asistencia</label>
                    <select class="input" name="id_tipo_asistencia" id="id_tipo_asistencia">
                        @foreach ($tipos_asistencias as $tipo_asistencia)
                            <option value="{{$tipo_asistencia->id}}" {{ $dato->id_tipo_asistencia == $tipo_asistencia->id ? 'selected' : '' }}>{{$tipo_asistencia->tipo_asistencia}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="patrocinador" class="encabezado-input">Patrocinador</label>
                    <input type="text" class="input" name="patrocinador" id="patrocinador" value="{{$dato->patrocinador}}">
                </div>
                
                <div class="inputs">
                    <label for="id_proyecto" class="encabezado-input">Proyecto</label>
                    <select class="input" name="id_proyecto" id="id_proyecto">
                        @foreach ($proyectos as $proyecto)
                            <option value="{{$proyecto->id}}" {{ $dato->id_proyecto == $proyecto->id ? 'selected' : '' }}>{{$proyecto->proyecto}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="cantidad_total_invitados" class="encabezado-input">Cantidad Total de Invitados</label>
                    <input type="number" class="input" name="cantidad_total_invitados" id="cantidad_total_invitados" value="{{$dato->cantidad_total_invitados}}">
                </div>
                
                <div class="inputs">
                    <label for="cantidad_asistidos" class="encabezado-input">Cantidad Asistidos</label>
                    <input type="number" class="input" name="cantidad_asistidos" id="cantidad_asistidos" value="{{$dato->cantidad_asistidos}}">
                </div>
                
                <div class="inputs">
                    <label for="cantidad_ausentes" class="encabezado-input">Cantidad Ausentes</label>
                    <input type="number" class="input" name="cantidad_ausentes" id="cantidad_ausentes" value="{{$dato->cantidad_ausentes}}">
                </div>
                
                <div class="inputs">
                    <label for="observacion" class="encabezado-input">Observación</label>
                    <input type="text" class="input" name="observacion" id="observacion" value="{{$dato->observacion}}">
                </div>
            </div>

            <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
        </form>
    </div>
@endsection