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
        <form class="marco" action="{{url('/notas')}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="id_expediente" class="encabezado-input">Expediente</label>
                    <select class="input @error('id_expediente') error @enderror" name="id_expediente" id="id_expediente">
                        @foreach ($expedientes as $expediente)
                            <option value="{{$expediente->id}}" {{ old('id_expediente') == $expediente->id ? 'selected' : '' }}>{{$expediente->nombre1}} {{$expediente->nombre2}} {{$expediente->apellido1}} {{$expediente->apellido2}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="promedio" class="encabezado-input">Promedio Ponderado</label>
                    <input type="text" class="input @error('promedio') error @enderror" name="promedio" id="promedio" value="{{ old('promedio') }}">
                </div>
                
                {{-- <div class="inputs">
                    <label for="fecha" class="encabezado-input">Fecha</label>
                    <input type="date" class="input @error('fecha') error @enderror" name="fecha" id="fecha" value="{{ old('fecha') }}">
                </div> --}}
                
                <div class="inputs">
                    <label for="id_grado_escolar" class="encabezado-input">Grado Escolar</label>
                    <select class="input @error('id_grado_escolar') error @enderror" name="id_grado_escolar" id="id_grado_escolar">
                        @foreach ($grados_ecolares as $grado)
                            <option value="{{$grado->id}}" {{ old('id_grado_escolar') == $grado->id ? 'selected' : '' }}>{{$grado->grado_escolar}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="id_ocupa_tutoria" class="encabezado-input">Ocupa Tutoría</label>
                    <select class="input @error('id_ocupa_tutoria') error @enderror" name="id_ocupa_tutoria" id="id_ocupa_tutoria">
                        @foreach ($ocupar_tutorias as $ocupar_tutoria)
                            <option value="{{$ocupar_tutoria->id}}" {{ old('id_ocupa_tutoria') == $ocupar_tutoria->id ? 'selected' : '' }}>{{$ocupar_tutoria->ocupa_tutoria}}</option>
                        @endforeach
                    </select>
                </div>
                
                {{-- <div class="inputs">
                    <label for="tipo_promedio" class="encabezado-input">Tipo de Promedio</label>
                    <select class="input @error('tipo_promedio') error @enderror" name="tipo_promedio" id="tipo_promedio">
                        <option value="Excelente" {{ old('tipo_promedio') == 'Excelente' ? 'selected' : '' }}>Excelente</option>
                        <option value="Muy bueno" {{ old('tipo_promedio') == 'Muy bueno' ? 'selected' : '' }}>Muy bueno</option>
                        <option value="Bueno" {{ old('tipo_promedio') == 'Bueno' ? 'selected' : '' }}>Bueno</option>
                        <option value="Malo" {{ old('tipo_promedio') == 'Malo' ? 'selected' : '' }}>Malo</option>
                    </select>
                </div> --}}
                
                <div class="inputs">
                    <label for="id_semaforo" class="encabezado-input">Semáforo</label>
                    <select class="input @error('id_semaforo') error @enderror" name="id_semaforo" id="id_semaforo">
                        @foreach ($semaforos as $semaforo)
                            <option value="{{$semaforo->id}}" {{ old('id_semaforo') == $semaforo->id ? 'selected' : '' }}>{{$semaforo->semaforo}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="inputs">
                    <label for="observaciones" class="encabezado-input">Observaciones</label>
                    <input type="text" class="input @error('observaciones') error @enderror" name="observaciones" id="observaciones" value="{{ old('observaciones') }}">
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
@endsection