<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Bajas de padrinos</p>
        @role('admin|creador')
        <a href="{{url('/bajas_de_padrinos/create')}}" class="btn-cambio-vista btn">
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
                    <td>Padrino</td>
                    <td>Expediente</td>
                    <td>Fecha de Baja</td>
                    <td>Detalle de Salida</td>
                    <td>Motivo de Baja</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @role('admin|editor')
                            <a href="{{url('/bajas_de_padrinos/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endrole
                            <a href="{{url('/bajas_de_padrinos/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td>{{$dato->padrinos->nombre}} {{$dato->padrinos->apellido}}</td>
                        <td>{{$dato->expedientes->nombre1}} {{$dato->expedientes->nombre2}} {{$dato->expedientes->apellido1}} {{$dato->expedientes->apellido2}}</td>
                        <td>{{$dato->fecha_baja}}</td>
                        <td class="text-left">{{$dato->detalle_salida ? $dato->detalle_salida : '-'}}</td>
                        <td class="text-left">{{$dato->motivo_bajas->motivo_baja}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="paginador">{{ $datos->links() }}</div>
    </div>
</div>