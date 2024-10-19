<?php

namespace App\Livewire;

use App\Models\Cumpleanio;
use Livewire\Component;
use Livewire\WithPagination;

class CumpleComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = Cumpleanio::with(['padrinos'])
        ->when($this->searchGeneral != null, function($query){
           $query->where(function($q){
               $q->whereRaw("DATE_FORMAT(fecha, '%Y-%m-%d') LIKE ?",['%'.$this->searchGeneral.'%'])
               ->orWhereHas('padrinos', function ($q){
                    $q->whereRaw("LOWER(CONCAT(nombre,' ',apellido)) LIKE ?",['%'.strtolower($this->searchGeneral).'%']);
               })
               ->whereRaw("DATE_FORMAT(fecha_entrega_carta, '%Y-%m-%d') LIKE ?",['%'.$this->searchGeneral.'%'])
               ->whereRaw("DATE_FORMAT(entrega_carta_presentacion, '%Y-%m-%d') LIKE ?",['%'.$this->searchGeneral.'%'])
               ->whereRaw("DATE_FORMAT(entrega_regalo, '%Y-%m-%d') LIKE ?",['%'.$this->searchGeneral.'%'])
               ->whereRaw("LOWER(observaciones) LIKE ?",['%'.strtolower($this->searchGeneral).'%'])
               ->whereRaw("LOWER(regalo) LIKE ?",['%'.strtolower($this->searchGeneral).'%']);
           }); 
        })
        ->paginate(20);

        return view('livewire.cumple-component', compact('datos'));
    }
}
