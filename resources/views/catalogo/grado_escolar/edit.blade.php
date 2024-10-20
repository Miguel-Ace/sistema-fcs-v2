@vite(['resources/js/catalogo/grado_escolar.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Grados escolares</p>

        <a href="{{url('/grados_escolares')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/grados_escolares'.'/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="grado_escolar" class="encabezado-input">Grado escolar</label>
                    <input type="text" class="input" name="grado_escolar" id="grado_escolar" value="{{$dato->grado_escolar}}">
                </div>
            </div>

            <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
        </form>
    </div>
</div>
@endsection