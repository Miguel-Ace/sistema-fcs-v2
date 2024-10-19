<?php

namespace App\Livewire;

use App\Models\TipoPobreza;
use Livewire\Component;
use Livewire\WithPagination;

class TipoPobrezaComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = TipoPobreza::when($this->searchGeneral != null, function($query){
            $query->where('tipo_pobreza','like','%'.$this->searchGeneral.'%');
        })
        ->paginate(20);

        return view('livewire.tipo-pobreza-component', compact('datos'));
    }
}
