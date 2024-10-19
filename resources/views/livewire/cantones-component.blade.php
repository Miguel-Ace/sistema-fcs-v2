<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo">Cantones</p>
        @role('admin|creador')
        <a href="{{url('/cantones/create/')}}" class="btn-cambio-vista btn">
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
                    <td>Cantón</td>
                    <td>Provincia</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td>
                            @role('admin|editor')
                            <a href="{{url('/cantones/edit/'.$dato->id)}}" class="btn-acciones"><i class="fa-solid fa-pen-to-square btn-ico-editar"></i></a>
                            @endrole
                            <a href="{{url('/cantones/view/'.$dato->id)}}" class="btn-acciones"><i class="fa-regular fa-eye btn-ico-view"></i></a>
                        </td>
                        <td>{{$dato->canton}}</td>
                        <td>{{$dato->provincias->provincia}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="paginador">{{ $datos->links() }}</div>
    </div>
</div>