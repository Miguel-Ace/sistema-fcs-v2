<?php

namespace App\Livewire;

use App\Models\Clinica;
use Livewire\Component;
use Livewire\WithPagination;

class ClinicaComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = Clinica::when($this->searchGeneral != null, function($query){
            $query->where('clinica','like','%'.$this->searchGeneral.'%');
        })
        ->paginate(20);
        return view('livewire.clinica-component', compact('datos'));
    }
}
