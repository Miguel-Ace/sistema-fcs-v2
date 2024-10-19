<?php

namespace App\Livewire;

use App\Models\TipoAsistencia;
use Livewire\Component;
use Livewire\WithPagination;

class TipoAsistenciaComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = TipoAsistencia::when($this->searchGeneral != null, function($query){
            $query->where('tipo_asistencia','like','%'.$this->searchGeneral.'%');
        })
        ->paginate(20);

        return view('livewire.tipo-asistencia-component', compact('datos'));
    }
}
