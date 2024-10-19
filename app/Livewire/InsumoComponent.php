<?php

namespace App\Livewire;

use App\Models\Insumo;
use Livewire\Component;
use Livewire\WithPagination;

class InsumoComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = Insumo::when($this->searchGeneral != null, function($query){
            $query->where('insumo','like','%'.$this->searchGeneral.'%');
        })
        ->paginate(20);

        return view('livewire.insumo-component', compact('datos'));
    }
}
