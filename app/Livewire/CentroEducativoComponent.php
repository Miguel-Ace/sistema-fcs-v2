<?php

namespace App\Livewire;

use App\Models\CentroEducativo;
use Livewire\Component;
use Livewire\WithPagination;

class CentroEducativoComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = CentroEducativo::when($this->searchGeneral != null, function($query){
            $query->where('centro_educativo','like','%'.$this->searchGeneral.'%');
        })
        ->paginate(20);

        return view('livewire.centro-educativo-component', compact('datos'));
    }
}
