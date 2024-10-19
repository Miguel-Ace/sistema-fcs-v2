@vite(['resources/js/catalogo/actividad.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Actividades</p>

        <a href="{{url('/actividades')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/actividades')}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="actividad" class="encabezado-input">Actividad</label>
                    <input type="text" class="input @error('actividad') error @enderror" name="actividad" id="actividad" value="{{ old('actividad') }}">
                </div>
                
                <div class="inputs">
                    <label for="fecha_creacion" class="encabezado-input">Fecha de Creación</label>
                    <input type="date" class="input @error('fecha_creacion') error @enderror" name="fecha_creacion" id="fecha_creacion" value="{{ old('fecha_creacion') }}">
                </div>
                
                <div class="inputs">
                    <label for="fecha_actividad" class="encabezado-input">Fecha de Actividad</label>
                    <input type="date" class="input @error('fecha_actividad') error @enderror" name="fecha_actividad" id="fecha_actividad" value="{{ old('fecha_actividad') }}">
                </div>
                
                <div class="inputs">
                    <label for="id_tipo_asistencia" class="encabezado-input">Tipo de Asistencia</label>
                    <select class="input @error('id_tipo_asistencia') error @enderror" name="id_tipo_asistencia" id="id_tipo_asistencia">
                        @foreach ($tipos_asistencias as $tipo_asistencia)
                            <option value="{{$tipo_asistencia->id}}" {{ old('id_tipo_asistencia') == $tipo_asistencia->id ? 'selected' : '' }}>{{$tipo_asistencia->tipo_asistencia}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="patrocinador" class="encabezado-input">Patrocinador</label>
                    <input type="text" class="input @error('patrocinador') error @enderror" name="patrocinador" id="patrocinador" value="{{ old('patrocinador') }}">
                </div>
                
                <div class="inputs">
                    <label for="id_proyecto" class="encabezado-input">Proyecto</label>
                    <select class="input @error('id_proyecto') error @enderror" name="id_proyecto" id="id_proyecto">
                        @foreach ($proyectos as $proyecto)
                            <option value="{{$proyecto->id}}" {{ old('id_proyecto') == $proyecto->id ? 'selected' : '' }}>{{$proyecto->proyecto}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="cantidad_total_invitados" class="encabezado-input">Cantidad Total de Invitados</label>
                    <input type="number" class="input @error('cantidad_total_invitados') error @enderror" name="cantidad_total_invitados" id="cantidad_total_invitados" value="{{ old('cantidad_total_invitados') }}">
                </div>
                
                <div class="inputs">
                    <label for="observacion" class="encabezado-input">Observación</label>
                    <input type="text" class="input @error('observacion') error @enderror" name="observacion" id="observacion" value="{{ old('observacion') }}">
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
</div>
@endsection