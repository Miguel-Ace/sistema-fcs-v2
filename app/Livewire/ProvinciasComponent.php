<?php

namespace App\Livewire;

use App\Models\Provincia;
use Livewire\Component;
use Livewire\WithPagination;

class ProvinciasComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = Provincia::when($this->searchGeneral != null, function($query){
            $query->where('provincia','like','%'.$this->searchGeneral.'%');
        })
        ->paginate(20);

        return view('livewire.provincias-component', compact('datos'));
    }
}
