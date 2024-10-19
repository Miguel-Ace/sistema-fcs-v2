<?php

namespace App\Livewire;

use App\Models\MotivoBaja;
use Livewire\Component;
use Livewire\WithPagination;

class MotivoBajaComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = MotivoBaja::when($this->searchGeneral != null, function($query){
            $query->where('motivo_baja','like','%'.$this->searchGeneral.'%');
        })
        ->paginate(20);

        return view('livewire.motivo-baja-component', compact('datos'));
    }
}
