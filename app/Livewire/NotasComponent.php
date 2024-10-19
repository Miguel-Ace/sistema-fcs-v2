<?php

namespace App\Livewire;

use App\Models\Nota;
use Livewire\Component;
use Livewire\WithPagination;

class NotasComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = Nota::with(['expedientes','grados_escolares','ocupa_tutorias','semaforos'])
        ->when($this->searchGeneral != null, function($query){
            $query->where(function($q){
                $q->where('promedio','like','%'.$this->searchGeneral.'%')
                ->orWhereHas('expedientes', function ($q){
                    $q->whereRaw("LOWER(CONCAT(nombre1,' ',nombre2,' ',apellido1,' ',apellido2)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                      ->orWhereRaw("LOWER(CONCAT(nombre1,' ',apellido1,' ',apellido2)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                      ->orWhereRaw("LOWER(CONCAT(nombre2,' ',apellido1,' ',apellido2)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereHas('grados_escolares', function ($q){
                    $q->where('grado_escolar','like','%'.$this->searchGeneral.'%');
                })
                ->orWhereHas('ocupa_tutorias', function ($q){
                    $q->whereRaw("LOWER(ocupa_tutoria) LIKE ?", ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereHas('semaforos', function ($q){
                    $q->whereRaw("LOWER(semaforo) LIKE ?", ['%'.strtolower($this->searchGeneral).'%']);
                });
            });
        })
        ->paginate(20);

        return view('livewire.notas-component', compact('datos'));
    }
}
