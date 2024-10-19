<?php

namespace App\Livewire;

use App\Models\Especialidad;
use Livewire\Component;
use Livewire\WithPagination;

class EspecialidadesComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = Especialidad::when($this->searchGeneral != null, function($query){
            $query->where('especialidad','like','%'.$this->searchGeneral.'%');
        })
        ->paginate(20);

        return view('livewire.especialidades-component', compact('datos'));
    }
}
