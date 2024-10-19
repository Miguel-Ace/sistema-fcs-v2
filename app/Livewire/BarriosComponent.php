<?php

namespace App\Livewire;

use App\Models\Barrio;
use Livewire\Component;
use Livewire\WithPagination;

class BarriosComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = Barrio::with(['cantones'])
        ->when($this->searchGeneral != null, function($query){
            $query->whereRaw("LOWER(barrio) LIKE ?",['%'.strtolower($this->searchGeneral).'%'])
            ->orWhereHas('cantones', function ($query){
                $query->whereRaw("LOWER(canton) LIKE ?",['%'.strtolower($this->searchGeneral).'%']);
            });
        })->paginate(20);

        return view('livewire.barrios-component', compact('datos'));
    }
}
