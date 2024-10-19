<?php

namespace App\Livewire;

use App\Models\GradosEscolare;
use Livewire\Component;
use Livewire\WithPagination;

class GradoEscolarComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = GradosEscolare::when($this->searchGeneral != null, function($query){
            $query->where('grado_escolar','like','%'.$this->searchGeneral.'%');
        })
        ->paginate(20);

        return view('livewire.grado-escolar-component', compact('datos'));
    }
}
