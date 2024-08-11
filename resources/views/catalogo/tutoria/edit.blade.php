@vite(['resources/js/catalogo/tutoria.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Tutorias</p>

        <a href="{{url('/tutorias')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/tutorias'.'/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="id_tutor" class="encabezado-input">Tutor</label>
                    <select class="input" name="id_tutor" id="id_tutor">
                        @foreach ($tutores as $tutor)
                            <option value="{{$tutor->id}}" {{ $dato->id_tutor == $tutor->id ? 'selected' : '' }}>
                                {{$tutor->tutor}}
                            </option>
                        @endforeach
                    </select>
                </div>
                
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
                    <label for="id_semaforo" class="encabezado-input">Semáforo</label>
                    <select class="input" name="id_semaforo" id="id_semaforo">
                        @foreach ($semaforos as $semaforo)
                            <option value="{{$semaforo->id}}" {{ $dato->id_semaforo == $semaforo->id ? 'selected' : '' }}>
                                {{$semaforo->semaforo}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="inputs">
                    <label for="nota" class="encabezado-input">Nota</label>
                    <input type="text" class="input" name="nota" id="nota" value="{{$dato->nota}}">
                </div>
            </div>

            <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
        </form>
    </div>
@endsection