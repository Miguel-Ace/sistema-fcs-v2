<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Tutorias</p>
        @role('admin|creador')
        <a href="{{url('/tutorias/create')}}" class="btn-cambio-vista btn">
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
                        <input type="text" name="buscar" placeholder="Buscar..." wire:model.live='searchGeneral'>
                    </td>
                </tr>
                <tr>
                    <td>-</td>
                    <td>Expediente</td>
                    <td>Tutor</td>
                    <td>Comunidad</td>
                    <td>Promedio</td>
                    <td>Semáforo</td>
                    <td>Observaciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @role('admin|editor')
                            <a href="{{url('/tutorias/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endrole
                            <a href="{{url('/tutorias/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td>{{$dato->expedientes->nombre1}} {{$dato->expedientes->nombre2}} {{$dato->expedientes->apellido1}} {{$dato->expedientes->apellido2}}</td>
                        <td class="text-left">{{$dato->tutores->tutor}}</td>
                        <td>{{$dato->comunidades->comunidad}}</td>
                        <td>{{$dato->promedio ?? 'No tiene promedio'}}</td>
                        <td>{{$dato->semaforos->semaforo}}</td>
                        <td>{{$dato->nota ?? '-'}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="paginador">{{ $datos->links() }}</div>
    </div>
</div>