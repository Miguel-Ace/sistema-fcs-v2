<?php

namespace App\Livewire;

use App\Models\Actividad;
use Livewire\Component;
use Livewire\WithPagination;

class ActividadComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = Actividad::with(['tipo_asistencias','proyectos'])
        ->when($this->searchGeneral != null, function($query){
            $query->where(function($q){
                $q->where('actividad','like','%'.$this->searchGeneral.'%')
                ->orWhereRaw("DATE_FORMAT(fecha_creacion, '%Y-%m-%d') LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                ->orWhereRaw("DATE_FORMAT(fecha_actividad, '%Y-%m-%d') LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                ->orWhereRaw("LOWER(patrocinador) LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                ->orWhereRaw("LOWER(observacion) LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                ->orWhereHas('tipo_asistencias', function ($q){
                    $q->whereRaw("LOWER(tipo_asistencia) LIKE ?", ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereHas('proyectos', function ($q){
                    $q->whereRaw("LOWER(proyecto) LIKE ?", ['%'.strtolower($this->searchGeneral).'%']);
                });
            });
        })
        ->paginate(20);

        return view('livewire.actividad-component', compact('datos'));
    }
}
