@vite(['resources/js/catalogo/notas.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Notas</p>

        <a href="{{url('/notas')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/notas'.'/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="id_expediente" class="encabezado-input">Expediente</label>
                    <select class="input" name="id_expediente" id="id_expediente">
                        @foreach ($expedientes as $expediente)
                            <option value="{{$expediente->id}}" {{ $dato->id_expediente == $expediente->id ? 'selected' : '' }}>{{$expediente->nombre1}} {{$expediente->nombre2}} {{$expediente->apellido1}} {{$expediente->apellido2}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="promedio" class="encabezado-input">Promedio</label>
                    <input type="text" class="input" name="promedio" id="promedio" value="{{$dato->promedio}}">
                </div>
                
                <div class="inputs">
                    <label for="fecha" class="encabezado-input">Fecha</label>
                    <input type="date" class="input" name="fecha" id="fecha" value="{{$dato->fecha}}">
                </div>
                
                <div class="inputs">
                    <label for="id_grado_escolar" class="encabezado-input">Grado Escolar</label>
                    <select class="input" name="id_grado_escolar" id="id_grado_escolar">
                        @foreach ($grados_ecolares as $grado)
                            <option value="{{$grado->id}}" {{ $dato->id_grado_escolar == $grado->id ? 'selected' : '' }}>{{$grado->grado_escolar}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="id_ocupa_tutoria" class="encabezado-input">Ocupa Tutoría</label>
                    <select class="input" name="id_ocupa_tutoria" id="id_ocupa_tutoria">
                        @foreach ($ocupar_tutorias as $ocupar_tutoria)
                            <option value="{{$ocupar_tutoria->id}}" {{ $dato->id_ocupa_tutoria == $ocupar_tutoria->id ? 'selected' : '' }}>{{$ocupar_tutoria->ocupa_tutoria}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="tipo_promedio" class="encabezado-input">Tipo de Promedio</label>
                    <select class="input @error('tipo_promedio') error @enderror" name="tipo_promedio" id="tipo_promedio">
                        <option value="Excelente" {{ $dato->tipo_promedio == 'Excelente' ? 'selected' : '' }}>Excelente</option>
                        <option value="Muy bueno" {{ $dato->tipo_promedio == 'Muy bueno' ? 'selected' : '' }}>Muy bueno</option>
                        <option value="Bueno" {{ $dato->tipo_promedio == 'Bueno' ? 'selected' : '' }}>Bueno</option>
                        <option value="Malo" {{ $dato->tipo_promedio == 'Malo' ? 'selected' : '' }}>Malo</option>
                    </select>
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
                    <label for="observaciones" class="encabezado-input">Observaciones</label>
                    <input type="text" class="input" name="observaciones" id="observaciones" value="{{$dato->observaciones}}">
                </div>
            </div>

            <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
        </form>
    </div>
@endsection