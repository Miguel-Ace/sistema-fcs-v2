<?php

namespace App\Livewire;

use App\Models\Estado;
use Livewire\Component;
use Livewire\WithPagination;

class EstadosComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = Estado::when($this->searchGeneral != null, function($query){
            $query->where('estado','like','%'.$this->searchGeneral.'%');
        })
        ->paginate(20);

        return view('livewire.estados-component', compact('datos'));
    }
}
