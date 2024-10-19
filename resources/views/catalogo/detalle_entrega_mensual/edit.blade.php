@vite(['resources/js/catalogo/evaluacion_medica.js'])

@extends('layout.plantilla_app')

@section('informacion')
<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo"><a href="{{url('/entregas_mensuales')}}">Entregas mensuales</a> / Detalle actividades</p>

        <a href="{{url('/entregas_mensuales/detalle_entregas_mensuales/'.$id_em)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/entregas_mensuales/detalle_entregas_mensuales/'.$dato->id.'/'.$id_em)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="id_tipoEntrega" class="encabezado-input">Semáforo</label>
                    <select class="input" name="id_tipoEntrega" id="id_tipoEntrega">
                        @foreach ($tipos_entregas as $tipo_entrega)
                            <option value="{{$tipo_entrega->id}}" {{ $dato->id_tipoEntrega == $tipo_entrega->id ? 'selected' : '' }}>{{$tipo_entrega->tipo_entrega}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
        </form>
    </div>
</div>
@endsection