<?php

namespace App\Livewire;

use App\Models\MetodosPago;
use Livewire\Component;
use Livewire\WithPagination;

class MetodoPagoComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = MetodosPago::when($this->searchGeneral != null, function($query){
            $query->where('metodo_pago','like','%'.$this->searchGeneral.'%');
        })
        ->paginate(20);

        return view('livewire.metodo-pago-component', compact('datos'));
    }
}
