<?php

namespace App\Livewire;

use App\Models\Cantone;
use Livewire\Component;
use Livewire\WithPagination;

class CantonesComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = Cantone::with(['provincias'])
        ->when($this->searchGeneral != null, function($query){
            $query->whereRaw("LOWER(canton) LIKE ?",['%'.strtolower($this->searchGeneral).'%'])
            ->orWhereHas('provincias', function ($query){
                $query->whereRaw("LOWER(provincia) LIKE ?",['%'.strtolower($this->searchGeneral).'%']);
            });
        })->paginate(20);

        return view('livewire.cantones-component', compact('datos'));
    }
}
