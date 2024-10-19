<?php

namespace App\Livewire;

use App\Models\TipoEntrega;
use Livewire\Component;
use Livewire\WithPagination;

class TipoEntregaComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = TipoEntrega::when($this->searchGeneral != null, function($query){
            $query->where('tipo_entrega','like','%'.$this->searchGeneral.'%');
        })
        ->paginate(20);

        return view('livewire.tipo-entrega-component', compact('datos'));
    }
}
