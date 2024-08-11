@vite(['resources/js/catalogo/evaluacion_medica.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo"><a href="{{url('/evaluaciones_medicas')}}">Evaluaciones médicas</a> / Enfermedades</p>

        <a href="{{url('/evaluaciones_medicas/enfermedades/'.$id_em)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/evaluaciones_medicas/enfermedades/'.$dato->id.'/'.$id_em)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="enfermedad" class="encabezado-input">Enfermedad</label>
                    <input type="text" class="input" name="enfermedad" id="enfermedad" value="{{$dato->enfermedad}}">
                </div>

                <div class="inputs">
                    <label for="medicamento" class="encabezado-input">Medicamento</label>
                    <input type="text" class="input" name="medicamento" id="medicamento" value="{{$dato->medicamento}}">
                </div>
            </div>

            <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
        </form>
    </div>
@endsection