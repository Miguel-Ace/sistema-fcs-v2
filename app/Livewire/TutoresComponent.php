<?php

namespace App\Livewire;

use App\Models\Tutor;
use Livewire\Component;
use Livewire\WithPagination;

class TutoresComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = Tutor::when($this->searchGeneral != null, function($query){
            $query->where('tutor','like','%'.$this->searchGeneral.'%');
        })
        ->paginate(20);

        return view('livewire.tutores-component', compact('datos'));
    }
}
