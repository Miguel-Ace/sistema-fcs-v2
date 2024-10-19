<?php

namespace App\Livewire;

use App\Models\EntregasMensuale;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class EntregaMensualComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    // Calcula las edades de los niños si el modelo tiene el expediente
    public function calcularEdades($datos){
        $edades = [];
        foreach ($datos as $dato) {
            $fechaNacimiento = $dato->expedientes->fecha_nacimiento;
            $convertirFechaNacimiento = Carbon::parse($fechaNacimiento);
            $edades[] = floor($convertirFechaNacimiento->diffInYears(Carbon::now()));
        }
        return $edades;
    }

    public function render()
    {
        $datos = EntregasMensuale::with(['expedientes','padrinos','insumos'])
        ->when($this->searchGeneral, function($query){
            $query->where(function($q){
                $q->whereRaw("DATE_FORMAT(fecha, '%Y-%m-%d') LIKE ?",['%'.$this->searchGeneral.'%'])
                ->orWhereHas('expedientes', function ($q){
                    $q->whereRaw("LOWER(CONCAT(nombre1,' ',nombre2,' ',apellido1,' ',apellido2)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                      ->orWhereRaw("LOWER(CONCAT(nombre1,' ',apellido1,' ',apellido2)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                      ->orWhereRaw("LOWER(CONCAT(nombre2,' ',apellido1,' ',apellido2)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereHas('padrinos', function ($q){
                    $q->whereRaw('LOWER(nombre) LIKE ?', ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereHas('insumos', function ($query){
                    $query->whereRaw('LOWER(insumo) LIKE ?', ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereRaw('LOWER(observaciones) LIKE ?', ['%'.strtolower($this->searchGeneral).'%']);
            });
        })
        ->paginate(20);

        $edades = $this->calcularEdades($datos);

        return view('livewire.entrega-mensual-component', compact('datos','edades'));
    }
}
