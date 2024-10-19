<div class="caja">
    <div class="encabezado-tabla">
        <p class="titulo"><a href="{{url('/actividades')}}">Actividades</a> / Detalle actividades</p>

        <a href="{{url('/actividades/detalles_actividades/'.$actividadId)}}" class="btn-cambio-vista btn">
            <i class="fa-solid fa-eye"></i>
            Ver Lista
        </a>
    </div>

    <div class="datos-mostrar">
        <table class="marco">
            <thead>
                <tr class="buscador">
                    <td>
                        <input type="search" name="buscar" placeholder="Buscar..." wire:model.live='serchGeneral'>
                    </td>
                </tr>
                <tr>
                    <td>Expediente</td>
                    <td 
                    style="display: flex; justify-content: center; align-items: center; gap: 1rem"
                    x-data="{
                            buscar: false,
                            primeraEdad: '',
                            segundaEdad: '',
                            formatPrimeraEdad() {
                                // Remover cualquier carácter no numérico
                                this.primeraEdad = this.primeraEdad.replace(/\D/g, '');
                            },
                            formatSegundaEdad() {
                                // Remover cualquier carácter no numérico
                                this.segundaEdad = this.segundaEdad.replace(/\D/g, '');
                            },
                            formatBuscador() {
                                this.buscar = !this.buscar;
                            }
                        }">
                        <input style="width: 50%;" type="search" placeholder="ejem: 0" x-show="buscar" x-model="primeraEdad" @input="formatPrimeraEdad()" wire:model.live='primeraEdad'>
                        <input style="width: 50%;" type="search" placeholder="ejem: 9" x-show="buscar" x-model="segundaEdad" @input="formatSegundaEdad()" wire:model.live='segundaEdad'>

                        <p x-show="!buscar">Edad</p>

                        <i class="fa-solid fa-magnifying-glass" style="cursor: pointer" x-show="!buscar" @click="formatBuscador()"></i>
                        <i class="fa-solid fa-xmark" style="cursor: pointer" x-show="buscar" @click="formatBuscador()"></i>
                    </td>
                    <td>Agregar</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($expedientes as $dato)
                    <tr>
                        <td>{{$dato->nombre1 . ' ' . $dato->nombre2 . ' ' . $dato->apellido1 . ' ' . $dato->apellido2}}</td>
                        <td>{{$dato->edad}}</td>
                        <td class="add-nino {{in_array($dato->id, $ids) ? 'activo': ''}}">
                            <button wire:click='detalle_actividad_store({{$dato->id}})'>
                                <i class="{{in_array($dato->id, $ids) ? 'fa-solid fa-check' : 'fa-solid fa-plus'}}"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="paginador">{{ $expedientes->links() }}</div>
    </div>
</div>
