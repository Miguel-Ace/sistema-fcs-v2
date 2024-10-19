<?php

namespace App\Livewire;

use App\Models\EvaluacionesMedica;
use Livewire\Component;
use Livewire\WithPagination;

class EvaluacionesMedicasComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render(){
        $datos = EvaluacionesMedica::with(['expedientes','clinicas'])
        ->when($this->searchGeneral != null, function($query){
            $query->where(function($q){
                $q->whereRaw("DATE_FORMAT(fecha, '%Y-%m-%d') LIKE ?", ['%'.$this->searchGeneral.'%'])
                ->orWhereHas('expedientes', function ($q){
                    $q->whereRaw("LOWER(CONCAT(nombre1,' ',nombre2,' ',apellido1,' ',apellido2)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                      ->orWhereRaw("LOWER(CONCAT(nombre1,' ',apellido1,' ',apellido2)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                      ->orWhereRaw("LOWER(CONCAT(nombre2,' ',apellido1,' ',apellido2)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereHas('clinicas', function ($q){
                    $q->whereRaw("LOWER(clinica) LIKE ?", ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhere('peso', 'like', '%'.$this->searchGeneral.'%')
                ->orWhere('talla', 'like', '%'.$this->searchGeneral.'%')
                ->orWhere('signos', 'like', '%'.$this->searchGeneral.'%')
                ->orWhereRaw("LOWER(notas) LIKE ?", ['%'.strtolower($this->searchGeneral).'%']);
            });
        })
        ->paginate(20);

        return view('livewire.evaluaciones-medicas-component', compact('datos'));
    }
}
