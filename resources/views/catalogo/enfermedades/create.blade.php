@vite(['resources/js/catalogo/evaluacion_medica.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo"><a href="{{url('/evaluaciones_medicas')}}">Evaluaciones médicas</a> / Enfermedades</p>

        <a href="{{url('/evaluaciones_medicas/enfermedades/'.$id_em)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/evaluaciones_medicas/enfermedades/'.$id_em)}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="enfermedad" class="encabezado-input">Enfermedad</label>
                    <input type="text" class="input @error('enfermedad') error @enderror" name="enfermedad" id="enfermedad" value="{{ old('enfermedad') }}">
                </div>
                
                <div class="inputs">
                    <label for="medicamento" class="encabezado-input">Medicamento</label>
                    <input type="text" class="input @error('medicamento') error @enderror" name="medicamento" id="medicamento" value="{{ old('medicamento') }}">
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
</div>
@endsection