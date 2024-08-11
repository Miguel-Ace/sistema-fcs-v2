@vite(['resources/js/catalogo/expediente.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Expedientes</p>

        <a href="{{url('/expedientes'.$dato->id_contratista)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/expedientes'.'/'.$dato->id)}}"  method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="id_comunidad" class="encabezado-input">Comunidad</label>
                    <select class="input" name="id_comunidad" id="id_comunidad">
                        @foreach ($comunidades as $comunidad)
                            <option value="{{$comunidad->id}}" {{ $dato->id_comunidad == $comunidad->id ? 'selected' : '' }}>{{$comunidad->comunidad}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="nombre1" class="encabezado-input">Primer Nombre</label>
                    <input type="text" class="input" name="nombre1" id="nombre1" value="{{$dato->nombre1}}">
                </div>
                <div class="inputs">
                    <label for="nombre2" class="encabezado-input">Segundo Nombre</label>
                    <input type="text" class="input" name="nombre2" id="nombre2" value="{{$dato->nombre2}}">
                </div>
                <div class="inputs">
                    <label for="apellido1" class="encabezado-input">Primer Apellido</label>
                    <input type="text" class="input" name="apellido1" id="apellido1" value="{{$dato->apellido1}}">
                </div>
                <div class="inputs">
                    <label for="apellido2" class="encabezado-input">Segundo Apellido</label>
                    <input type="text" class="input"  name="apellido2" id="apellido2" value="{{$dato->apellido2}}">
                </div>
                <div class="inputs">
                    <label for="pp" class="encabezado-input">PP</label>
                    <select class="input"  name="pp" id="pp">
                        <option value="Si" {{$dato->pp == 'Si' ? 'selected' : ''}}>Si</option>
                        <option value="No" {{$dato->pp == 'No' ? 'selected' : ''}}>No</option>
                    </select>
                </div>
                <div class="inputs">
                    <label for="id_estado" class="encabezado-input">Estado</label>
                    <select class="input" name="id_estado" id="id_estado">
                        @foreach ($estados as $estado)
                            <option value="{{$estado->id}}" {{ $dato->id_estado == $estado->id ? 'selected' : '' }}>{{$estado->estado}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="id_sexo" class="encabezado-input">Sexo</label>
                    <select class="input" name="id_sexo" id="id_sexo">
                        @foreach ($sexos as $sexo)
                            <option value="{{$sexo->id}}" {{ $dato->id_sexo == $sexo->id ? 'selected' : '' }}>{{$sexo->sexo}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="cedula" class="encabezado-input">Cédula</label>
                    <input type="text" class="input" name="cedula" id="cedula" value="{{$dato->cedula}}">
                </div>
                <div class="inputs">
                    <label for="id_tipo_pobreza" class="encabezado-input">Tipo de Pobreza</label>
                    <select class="input" name="id_tipo_pobreza" id="id_tipo_pobreza">
                        @foreach ($tipoPobrezas as $tipoPobreza)
                            <option value="{{$tipoPobreza->id}}" {{ $dato->id_tipo_pobreza == $tipoPobreza->id ? 'selected' : '' }}>{{$tipoPobreza->tipo_pobreza}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="id_barrio" class="encabezado-input">Barrio</label>
                    <select class="input" name="id_barrio" id="id_barrio">
                        @foreach ($barrios as $barrio)
                            <option value="{{$barrio->id}}" {{ $dato->id_barrio == $barrio->id ? 'selected' : '' }}>{{$barrio->barrio}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="fecha_nacimiento" class="encabezado-input">Fecha de Nacimiento</label>
                    <input type="date" class="input" name="fecha_nacimiento" id="fecha_nacimiento" value="{{$dato->fecha_nacimiento}}">
                </div>
                <div class="inputs">
                    <label for="contacto_representante" class="encabezado-input">Contacto Representante</label>
                    <input type="text" class="input" name="contacto_representante" id="contacto_representante" value="{{$dato->contacto_representante}}">
                </div>
                <div class="inputs">
                    <label for="id_grado_escolar" class="encabezado-input">Grado Escolar</label>
                    <select class="input" name="id_grado_escolar" id="id_grado_escolar">
                        @foreach ($gradosEscolares as $gradoEscolar)
                            <option value="{{$gradoEscolar->id}}" {{ $dato->id_grado_escolar == $gradoEscolar->id ? 'selected' : '' }}>{{$gradoEscolar->grado_escolar}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="talla_pantalon" class="encabezado-input">Talla Pantalón</label>
                    <input type="text" class="input" name="talla_pantalon" id="talla_pantalon" value="{{$dato->talla_pantalon}}">
                </div>
                <div class="inputs">
                    <label for="talla_camisa" class="encabezado-input">Talla Camisa</label>
                    <input type="text" class="input" name="talla_camisa" id="talla_camisa" value="{{$dato->talla_camisa}}">
                </div>
                <div class="inputs">
                    <label for="talla_zapato" class="encabezado-input">Talla Zapato</label>
                    <input type="text" class="input" name="talla_zapato" id="talla_zapato" value="{{$dato->talla_zapato}}">
                </div>
                <div class="inputs">
                    <label for="id_activo" class="encabezado-input">Activo</label>
                    <select class="input" name="id_activo" id="id_activo">
                        @foreach ($activos as $activo)
                            <option value="{{$activo->id}}" {{ $dato->id_activo == $activo->id ? 'selected' : '' }}>{{$activo->activo}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="nombre_encargado" class="encabezado-input">Nombre Encargado</label>
                    <input type="text" class="input" name="nombre_encargado" id="nombre_encargado" value="{{$dato->nombre_encargado}}">
                </div>
                <div class="inputs">
                    <label for="telefono_encargado" class="encabezado-input">Teléfono Encargado</label>
                    <input type="number" class="input" name="telefono_encargado" id="telefono_encargado" value="{{$dato->telefono_encargado}}">
                </div>
                <div class="inputs">
                    <label for="id_centro_educativo" class="encabezado-input">Centro Educativo</label>
                    <select class="input" name="id_centro_educativo" id="id_centro_educativo">
                        @foreach ($centrosEducativos as $centroEducativo)
                            <option value="{{$centroEducativo->id}}" {{ $dato->id_centro_educativo == $centroEducativo->id ? 'selected' : '' }}>{{$centroEducativo->centro_educativo}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="id_padrino" class="encabezado-input">Padrino</label>
                    <select class="input" name="id_padrino" id="id_padrino">
                        @foreach ($padrinos as $padrino)
                            <option value="{{$padrino->id}}" {{ $dato->id_padrino == $padrino->id ? 'selected' : '' }}>{{$padrino->nombre}} {{$padrino->apellido}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="id_beca" class="encabezado-input">Beca</label>
                    <select class="input" name="id_beca" id="id_beca">
                        @foreach ($becas as $beca)
                            <option value="{{$beca->id}}" {{ $dato->id_beca == $beca->id ? 'selected' : '' }}>{{$beca->beca}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button class="btn btn-editar"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
        </form>
    </div>
@endsection