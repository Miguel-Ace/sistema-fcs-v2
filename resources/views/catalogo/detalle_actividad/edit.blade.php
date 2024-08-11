@vite(['resources/js/catalogo/evaluacion_medica.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo"><a href="{{url('/actividades')}}">Actividades</a> / Detalle actividades : {{$dato->expedientes->nombre1}} {{$dato->expedientes->nombre2}} {{$dato->expedientes->apellido1}} {{$dato->expedientes->apellido2}}</p>

        <a href="{{url('/actividades/detalles_actividades/'.$id_a)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/actividades/detalles_actividades/'.$dato->id.'/'.$id_a)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="contenedor-inputs">
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
            </div>

            <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
        </form>
    </div>
@endsection