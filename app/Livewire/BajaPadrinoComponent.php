<?php

namespace App\Livewire;

use App\Models\BajasPadrino;
use Livewire\Component;
use Livewire\WithPagination;

class BajaPadrinoComponent extends Component
{
    use WithPagination;
    public $searchGeneral;

    public function render()
    {
        $datos = BajasPadrino::with(['padrinos','expedientes','motivo_bajas'])
        ->when($this->searchGeneral != null, function($query){
            $query->where(function($q){
                $q->orWhereRaw("DATE_FORMAT(fecha_baja, '%Y-%m-%d') LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                ->orWhereHas('expedientes', function ($q){
                    $q->whereRaw("LOWER(CONCAT(nombre1,' ',nombre2,' ',apellido1,' ',apellido2)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                      ->orWhereRaw("LOWER(CONCAT(nombre1,' ',apellido1,' ',apellido2)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%'])
                      ->orWhereRaw("LOWER(CONCAT(nombre2,' ',apellido1,' ',apellido2)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereHas('motivo_bajas', function ($q){
                    $q->whereRaw('LOWER(motivo_baja) LIKE ?', ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereHas('padrinos', function ($q){
                    $q->whereRaw("LOWER(CONCAT(nombre,' ',apellido)) LIKE ?", ['%'.strtolower($this->searchGeneral).'%']);
                })
                ->orWhereRaw('LOWER(detalle_salida) LIKE ?', ['%'.strtolower($this->searchGeneral).'%']);
            });
        })
        ->paginate(20);

        return view('livewire.baja-padrino-component', compact('datos'));
    }
}
