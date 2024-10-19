<?php

namespace App\Livewire;

use App\Models\Banco;
use Livewire\Component;
use Livewire\WithPagination;

class BancosComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = Banco::when($this->searchGeneral != null, function($query){
            $query->where('banco','like','%'.$this->searchGeneral.'%');
        })
        ->paginate(20);

        return view('livewire.bancos-component', compact('datos'));
    }
}
