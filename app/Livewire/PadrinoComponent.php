<?php

namespace App\Livewire;

use Livewire\WithPagination;
use App\Models\Padrino;
use Livewire\Component;

class PadrinoComponent extends Component
{
    use WithPagination;
    public $serchGeral = '';
    public $serchMesCumple = '';

    public function render(){
        $datos = Padrino::with(['provincias','cantones','barrios','metodos_pagos','bancos'])
        ->when($this->serchGeral != '', function($query){
           $query
           ->whereRaw('LOWER(nombre) LIKE ?',['%'.strtolower($this->serchGeral).'%'])
           ->orWhereRaw('LOWER(apellido) LIKE ?',['%'.strtolower($this->serchGeral).'%'])
           ->orWhereRaw('LOWER(telefono) LIKE ?',['%'.strtolower($this->serchGeral).'%'])
           ->orWhereRaw('LOWER(direccion) LIKE ?',['%'.strtolower($this->serchGeral).'%'])
           ->orWhereRaw('LOWER(correo) LIKE ?',['%'.strtolower($this->serchGeral).'%'])
           ->orWhereRaw('LOWER(tipo) LIKE ?',['%'.strtolower($this->serchGeral).'%'])
           ->orWhereRaw('LOWER(mes_nacimiento) LIKE ?',['%'.strtolower($this->serchGeral).'%'])
           ->orWhereRaw('DATE_FORMAT(fecha_inicio, "%Y-%m-%d") LIKE ?',['%'.strtolower($this->serchGeral).'%'])
           ->orWhereRaw('DATE_FORMAT(fecha_final, "%Y-%m-%d") LIKE ?',['%'.strtolower($this->serchGeral).'%'])
           ->orWhereRaw('DATE_FORMAT(fecha_nacimiento, "%Y-%m-%d") LIKE ?',['%'.strtolower($this->serchGeral).'%'])
           ->orWhereHas('provincias', function ($q){
                $q->where('provincia', 'LIKE', "%{$this->serchGeral}%");
            })
            ->orWhereHas('cantones', function ($q){
                $q->where('canton', 'LIKE', "%{$this->serchGeral}%");
            })
            ->orWhereHas('barrios', function ($q){
                $q->where('barrio', 'LIKE', "%{$this->serchGeral}%");
            })
            ->orWhereHas('metodos_pagos', function ($q){
                $q->where('metodo_pago', 'LIKE', "%{$this->serchGeral}%");
            })
            ->orWhereHas('bancos', function ($q){
                $q->where('banco', 'LIKE', "%{$this->serchGeral}%");
            });
        })
        ->when($this->serchMesCumple != '', function($query){
            $query->orWhereRaw('LOWER(mes_nacimiento) LIKE ?',['%'.strtolower($this->serchMesCumple).'%']);
        })
        ->paginate(20);
        return view('livewire.padrino-component', compact('datos'));
    }
}
