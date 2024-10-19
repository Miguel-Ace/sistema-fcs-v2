<?php

namespace App\Livewire;

use App\Models\Tutoria;
use Livewire\Component;
use Livewire\WithPagination;

class TutoriaComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = Tutoria::with(['tutores','expedientes','comunidades','semaforos'])
        ->when($this->searchGeneral != null, function($query){
            $query->where(function($q){
                $q->where('promedio','like','%'.$this->searchGeneral.'%')
                ->orWhereHas('tutores', function ($q){
                    $q->whereRaw('LOWER(tutor) LIKE ?', ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereHas('expedientes', function ($q){
                    $q->whereRaw("LOWER(CONCAT(nombre1,' ',nombre2,' ',apellido1,' ',apellido2)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                      ->orWhereRaw("LOWER(CONCAT(nombre1,' ',apellido1,' ',apellido2)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                      ->orWhereRaw("LOWER(CONCAT(nombre2,' ',apellido1,' ',apellido2)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereHas('comunidades', function ($q) {
                    $q->whereRaw("LOWER(comunidad) LIKE ?", ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->whereHas('semaforos', function ($q) {
                    $q->orWhereRaw("LOWER(semaforo) LIKE ?", ['%'.strtolower($this->searchGeneral).'%']);
                });
            });
        })
        ->paginate(20);

        return view('livewire.tutoria-component', compact('datos'));
    }
}
