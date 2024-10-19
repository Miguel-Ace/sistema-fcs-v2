<?php

namespace App\Livewire;

use App\Models\Expediente;
use Livewire\Component;
use Livewire\WithPagination;

class ExpedienteComponent extends Component
{
    use WithPagination;

    public $searchGeneral;

    public function render()
    {
        $datos = Expediente::with(['becas','activos','sexos','comunidades','estados','tipo_pobrezas','barrios','grados_escolares','centro_educativos','padrinos'])
        ->when($this->searchGeneral != null, function($query){
            $query->where(function($q){
                $q->whereRaw('LOWER(codigo_nino) LIKE ?', ['%'.strtolower($this->searchGeneral).'%'])
                ->orWhereHas('comunidades', function ($q){
                    $q->whereRaw('LOWER(comunidad) LIKE ?', ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereHas('becas', function ($q){
                    $q->whereRaw('LOWER(beca) LIKE ?', ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereHas('activos', function ($q){
                    $q->whereRaw('LOWER(activo) LIKE ?', ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereHas('sexos', function ($q){
                    $q->whereRaw('LOWER(sexo) LIKE ?', ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereHas('estados', function ($q){
                    $q->whereRaw('LOWER(estado) LIKE ?', ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereHas('tipo_pobrezas', function ($q){
                    $q->whereRaw('LOWER(tipo_pobreza) LIKE ?', ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereHas('barrios', function ($q){
                    $q->whereRaw('LOWER(barrio) LIKE ?', ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereHas('grados_escolares', function ($q){
                    $q->whereRaw('LOWER(grado_escolar) LIKE ?', ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereHas('centro_educativos', function ($q){
                    $q->whereRaw('LOWER(centro_educativo) LIKE ?', ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereHas('padrinos', function ($q){
                    $q->whereRaw('LOWER(nombre) LIKE ?', ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereRaw("LOWER(CONCAT(nombre1, ' ', nombre2, ' ', apellido1, ' ', apellido2)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                ->orWhereRaw("LOWER(CONCAT(nombre1, ' ', apellido1, ' ', apellido2)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                ->orWhereRaw("LOWER(CONCAT(nombre2, ' ', apellido1, ' ', apellido2)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                ->orWhereRaw("LOWER(CONCAT(nombre2, ' ', apellido2)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                ->orWhereRaw("LOWER(nombre_encargado) LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                ->orWhereRaw("DATE_FORMAT(fecha_nacimiento, '%Y-%m-%d') LIKE ?", ['%'.strtolower($this->searchGeneral).'%']);
                // ->orWhere('telefono_encargado','LIKE', '%'.$this->searchGeneral.'%')
                // ->orWhere('pp', 'LIKE', "%{$buscar}%")
                // ->orWhere('cedula', 'LIKE', "%{$buscar}%")
                // ->orWhere('contacto_representante', 'LIKE', "%{$buscar}%")
                // ->orWhere('talla_pantalon', 'LIKE', "%{$buscar}%")
                // ->orWhere('talla_camisa', 'LIKE', "%{$buscar}%")
                // ->orWhere('talla_zapato', 'LIKE', "%{$buscar}%")
            });
        })
        ->paginate(10);
        
        return view('livewire.expediente-component', compact('datos'));
    }
}
