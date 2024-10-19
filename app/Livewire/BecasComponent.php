<?php

namespace App\Livewire;

use App\Models\Beca;
use Livewire\Component;
use Livewire\WithPagination;

class BecasComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = Beca::when($this->searchGeneral != null, function($query){
            $query->where('beca','like','%'.$this->searchGeneral.'%');
        })
        ->paginate(20);

        return view('livewire.becas-component', compact('datos'));
    }
}
