<?php

namespace App\Livewire;

use App\Models\Proyecto;
use Livewire\Component;
use Livewire\WithPagination;

class ProyectosComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = Proyecto::when($this->searchGeneral != null, function($query){
            $query->where('proyecto','like','%'.$this->searchGeneral.'%');
        })
        ->paginate(20);

        return view('livewire.proyectos-component', compact('datos'));
    }
}
