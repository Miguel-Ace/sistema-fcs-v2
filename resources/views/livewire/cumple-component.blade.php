<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Cumpleaños</p>
        @role('admin|creador')
        <a href="{{url('/cumpleaños/create')}}" class="btn-cambio-vista btn">
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
                    <td>Fecha</td>
                    <td>Fecha de Entrega de Carta</td>
                    <td>Entrega de Carta de Presentación</td>
                    <td>Entrega de Regalo</td>
                    <td>Observaciones</td>
                    <td>Regalo</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @role('admin|editor')
                            <a href="{{url('/cumpleaños/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endrole
                            <a href="{{url('/cumpleaños/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td>{{$dato->padrinos->nombre}} {{$dato->padrinos->apellido}}</td>
                        <td>{{$dato->fecha}}</td>
                        <td>{{$dato->fecha_entrega_carta}}</td>
                        <td>{{$dato->entrega_carta_presentacion}}</td>
                        <td>{{$dato->entrega_regalo}}</td>
                        <td>{{$dato->observaciones ? $dato->observaciones : '-'}}</td>
                        <td>{{$dato->regalo}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="paginador">{{ $datos->links() }}</div>
    </div>
</div>