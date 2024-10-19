<?php

namespace App\Livewire;

use App\Models\Comunidad;
use Livewire\Component;
use Livewire\WithPagination;

class ComunidadesComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = Comunidad::when($this->searchGeneral != null, function($query){
            $query->where('comunidad','like','%'.$this->searchGeneral.'%');
        })
        ->paginate(20);

        return view('livewire.comunidades-component', compact('datos'));
    }
}
