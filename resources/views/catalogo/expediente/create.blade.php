@vite(['resources/js/catalogo/expediente.js'])

@extends('layout.plantilla_app')

@section('informacion')
    <div class="encabezado-tabla">
        <p class="titulo">Expedientes</p>

        <a href="{{url('/expedientes')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <form class="marco" action="{{url('/expedientes')}}"  method="post" enctype="multipart/form-data">
            @csrf
            <div class="contenedor-inputs">
                <div class="inputs">
                    <label for="id_comunidad" class="encabezado-input">Comunidad</label>
                    <select class="input @error('id_comunidad') error @enderror" name="id_comunidad" id="id_comunidad" value="{{old('id_comunidad')}}">
                        @foreach ($comunidades as $comunidad)
                            <option value="{{$comunidad->id}}">{{$comunidad->comunidad}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="nombre1" class="encabezado-input">Primer Nombre</label>
                    <input type="text" class="input @error('nombre1') error @enderror" name="nombre1" id="nombre1" value="{{old('nombre1')}}">
                </div>
                <div class="inputs">
                    <label for="nombre2" class="encabezado-input">Segundo Nombre</label>
                    <input type="text" class="input @error('nombre2') error @enderror" name="nombre2" id="nombre2" value="{{old('nombre2')}}">
                </div>
                <div class="inputs">
                    <label for="apellido1" class="encabezado-input">Primer Apellido</label>
                    <input type="text" class="input @error('apellido1') error @enderror" name="apellido1" id="apellido1" value="{{old('apellido1')}}">
                </div>
                <div class="inputs">
                    <label for="apellido2" class="encabezado-input">Segundo Apellido</label>
                    <input type="text" class="input @error('apellido2') error @enderror" name="apellido2" id="apellido2" value="{{old('apellido2')}}">
                </div>
                <div class="inputs">
                    <label for="pp" class="encabezado-input">PP</label>
                    <select class="input @error('pp') error @enderror" name="pp" id="pp" value="{{old('pp')}}">
                        <option value="Si" {{old('pp') == 'Si' ? 'selected' : ''}}>Si</option>
                        <option value="No" {{old('pp') == 'No' ? 'selected' : ''}}>No</option>
                    </select>
                </div>
                <div class="inputs">
                    <label for="id_estado" class="encabezado-input">Estado</label>
                    <select class="input @error('id_estado') error @enderror" name="id_estado" id="id_estado" value="{{old('id_estado')}}">
                        @foreach ($estados as $estado)
                            <option value="{{$estado->id}}">{{$estado->estado}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="id_sexo" class="encabezado-input">Sexo</label>
                    <select class="input @error('id_sexo') error @enderror" name="id_sexo" id="id_sexo" value="{{old('id_sexo')}}">
                        @foreach ($sexos as $sexo)
                            <option value="{{$sexo->id}}">{{$sexo->sexo}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="cedula" class="encabezado-input">Cédula</label>
                    <input type="text" class="input @error('cedula') error @enderror" name="cedula" id="cedula" value="{{old('cedula')}}">
                </div>
                <div class="inputs">
                    <label for="id_tipo_pobreza" class="encabezado-input">Tipo de Pobreza</label>
                    <select class="input @error('id_tipo_pobreza') error @enderror" name="id_tipo_pobreza" id="id_tipo_pobreza" value="{{old('id_tipo_pobreza')}}">
                        @foreach ($tipoPobrezas as $tipoPobreza)
                            <option value="{{$tipoPobreza->id}}">{{$tipoPobreza->tipo_pobreza}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="id_barrio" class="encabezado-input">Barrio</label>
                    <select class="input @error('id_barrio') error @enderror" name="id_barrio" id="id_barrio" value="{{old('id_barrio')}}">
                        @foreach ($barrios as $barrio)
                            <option value="{{$barrio->id}}">{{$barrio->barrio}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="fecha_nacimiento" class="encabezado-input">Fecha de Nacimiento</label>
                    <input type="date" class="input @error('fecha_nacimiento') error @enderror" name="fecha_nacimiento" id="fecha_nacimiento" value="{{old('fecha_nacimiento')}}">
                </div>
                <div class="inputs">
                    <label for="contacto_representante" class="encabezado-input">Contacto Representante</label>
                    <input type="text" class="input @error('contacto_representante') error @enderror" name="contacto_representante" id="contacto_representante" value="{{old('contacto_representante')}}">
                </div>
                <div class="inputs">
                    <label for="id_grado_escolar" class="encabezado-input">Grado Escolar</label>
                    <select class="input @error('id_grado_escolar') error @enderror" name="id_grado_escolar" id="id_grado_escolar" value="{{old('id_grado_escolar')}}">
                        @foreach ($gradosEscolares as $gradoEscolar)
                            <option value="{{$gradoEscolar->id}}">{{$gradoEscolar->grado_escolar}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="talla_pantalon" class="encabezado-input">Talla Pantalón</label>
                    <input type="text" class="input @error('talla_pantalon') error @enderror" name="talla_pantalon" id="talla_pantalon" value="{{old('talla_pantalon')}}">
                </div>
                <div class="inputs">
                    <label for="talla_camisa" class="encabezado-input">Talla Camisa</label>
                    <input type="text" class="input @error('talla_camisa') error @enderror" name="talla_camisa" id="talla_camisa" value="{{old('talla_camisa')}}">
                </div>
                <div class="inputs">
                    <label for="talla_zapato" class="encabezado-input">Talla Zapato</label>
                    <input type="text" class="input @error('talla_zapato') error @enderror" name="talla_zapato" id="talla_zapato" value="{{old('talla_zapato')}}">
                </div>
                <div class="inputs">
                    <label for="id_activo" class="encabezado-input">Activo</label>
                    <select class="input @error('id_activo') error @enderror" name="id_activo" id="id_activo" value="{{old('id_activo')}}">
                        @foreach ($activos as $activo)
                            <option value="{{$activo->id}}">{{$activo->activo}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="nombre_encargado" class="encabezado-input">Nombre Encargado</label>
                    <input type="text" class="input @error('nombre_encargado') error @enderror" name="nombre_encargado" id="nombre_encargado" value="{{old('nombre_encargado')}}">
                </div>
                <div class="inputs">
                    <label for="telefono_encargado" class="encabezado-input">Teléfono Encargado</label>
                    <input type="number" class="input @error('telefono_encargado') error @enderror" name="telefono_encargado" id="telefono_encargado" value="{{old('telefono_encargado')}}">
                </div>
                <div class="inputs">
                    <label for="id_centro_educativo" class="encabezado-input">Centro Educativo</label>
                    <select class="input @error('id_centro_educativo') error @enderror" name="id_centro_educativo" id="id_centro_educativo" value="{{old('id_centro_educativo')}}">
                        @foreach ($centrosEducativos as $centroEducativo)
                            <option value="{{$centroEducativo->id}}">{{$centroEducativo->centro_educativo}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="id_padrino" class="encabezado-input">Padrino</label>
                    <select class="input @error('id_padrino') error @enderror" name="id_padrino" id="id_padrino" value="{{old('id_padrino')}}">
                        @foreach ($padrinos as $padrino)
                            <option value="{{$padrino->id}}">{{$padrino->nombre}} {{$padrino->apellido}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="inputs">
                    <label for="id_beca" class="encabezado-input">Beca</label>
                    <select class="input @error('id_beca') error @enderror" name="id_beca" id="id_beca" value="{{old('id_beca')}}">
                        @foreach ($becas as $beca)
                            <option value="{{$beca->id}}">{{$beca->beca}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button class="btn btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </form>
    </div>
@endsection