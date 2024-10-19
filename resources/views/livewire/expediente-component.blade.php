<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Expedientes</p>
        @role('admin|creador')
        <a href="{{url('/expedientes/create')}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-plus"></i>
            Crear Nuevo
        </a>
        @endrole
    </div>

    <div class="datos-mostrar">
        <table class="marco">
            <thead>
                <tr class="buscador">
                    <td>
                        <input type="search" name="buscar" placeholder="Buscar..." wire:model.live='searchGeneral'>
                    </td>
                </tr>
                <tr>
                    <td>-</td>
                    <td>Comunidad</td>
                    <td>Código del niño</td>
                    <td>Nombre</td>
                    <td>PP</td>
                    <td>Estado</td>
                    <td>Sexo</td>
                    <td>Cédula</td>
                    <td>Tipo de pobreza</td>
                    <td>barrio</td>
                    <td>Fecha de nacimiento</td>
                    <td>Contacto del representante</td>
                    <td>Grado escolar</td>
                    <td>Talla de pantalon</td>
                    <td>Talla de camisa</td>
                    <td>Talla de zapato</td>
                    <td>Activo</td>
                    <td>Nombre del encargado</td>
                    <td>Teléfono del encargado</td>
                    <td>Centro educativo</td>
                    <td>Beca</td>
                    <td>Padrino</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @role('admin|editor')
                            <a href="{{url('/expedientes/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endrole
                            <a href="{{url('/expedientes/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td>{{$dato->comunidades->comunidad}}</td>
                        <td>{{$dato->codigo_nino}}</td>
                        <td>{{$dato->nombre1}} {{$dato->nombre2}} {{$dato->apellido1}} {{$dato->apellido2}}</td>
                        <td>{{$dato->pp}}</td>
                        <td>{{$dato->estados->estado}}</td>
                        <td>{{$dato->sexos->sexo}}</td>
                        <td>{{$dato->cedula}}</td>
                        <td>{{$dato->tipo_pobrezas->tipo_pobreza}}</td>
                        <td>{{$dato->barrios->barrio}}</td>
                        <td>{{$dato->fecha_nacimiento}}</td>
                        <td>{{$dato->contacto_representante}}</td>
                        <td>{{$dato->grados_escolares->grado_escolar}}</td>
                        <td>{{$dato->talla_pantalon}}</td>
                        <td>{{$dato->talla_camisa}}</td>
                        <td>{{$dato->talla_zapato}}</td>
                        <td>{{$dato->activos->activo}}</td>
                        <td>{{$dato->nombre_encargado ? $dato->nombre_encargado : '-'}}</td>
                        <td>{{$dato->telefono_encargado}}</td>
                        <td>{{$dato->centro_educativos->centro_educativo}}</td>
                        <td>{{$dato->becas->beca}}</td>
                        <td  class="text-left">{{$dato->padrinos->nombre}} {{$dato->padrinos->apellido}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="paginador">{{ $datos->links() }}</div>
    </div>
</div>