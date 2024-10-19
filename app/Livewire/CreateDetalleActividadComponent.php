<?php

namespace App\Livewire;

use Livewire\WithPagination;
use App\Models\Actividad;
use App\Models\DetalleActividad;
use App\Models\Expediente;
use Livewire\Component;

class CreateDetalleActividadComponent extends Component
{
    use WithPagination;
    public $serchGeneral;
    public $actividadId;
    public $primeraEdad;
    public $segundaEdad;

    // Estraer todo los niños que están en la actividad
    public function expedientesEnActividad() {
        $expedienteEnActividad = DetalleActividad::where('id_actividad',$this->actividadId)->pluck('id_expediente')->toArray();
        return $expedienteEnActividad;
    }

    // Ver si el niño está en la actividad
    public function activo($idExpediente) {
        $expediente = DetalleActividad::where('id_actividad',$this->actividadId)
        ->where('id_expediente',$idExpediente)->first();

        return $expediente ? true : false;
    }

    // Saber si hay o no espacio para agregar más niños
    public function cantidad_invitados() {
        $datos = DetalleActividad::where('id_actividad',$this->actividadId)->get();
        $cant_invitados = Actividad::find($this->actividadId)->cantidad_total_invitados;
        $hay_cupos = count($datos) < $cant_invitados;
        return $hay_cupos;
    }

    public function render()
    {
        $ids = $this->expedientesEnActividad();

        $expedientes = Expediente::when($this->serchGeneral != null, function($query){
            $query->where(function($q){
                $q->whereRaw('LOWER(nombre1) LIKE ?', ['%'.strtolower($this->serchGeneral).'%'])
                  ->orWhereRaw('LOWER(nombre2) LIKE ?', ['%'.strtolower($this->serchGeneral).'%'])
                  ->orWhereRaw('LOWER(apellido1) LIKE ?', ['%'.strtolower($this->serchGeneral).'%'])
                  ->orWhereRaw('LOWER(apellido2) LIKE ?', ['%'.strtolower($this->serchGeneral).'%'])
                  ->orWhereRaw('LOWER(CONCAT(nombre1, " ", nombre2)) LIKE ?', ['%'.strtolower($this->serchGeneral).'%']) // Combina nombre1 y nombre2
                  ->orWhereRaw('LOWER(CONCAT(apellido1, " ", apellido2)) LIKE ?', ['%'.strtolower($this->serchGeneral).'%']) // Combina apellidos
                  ->orWhereRaw('LOWER(CONCAT(nombre1, " ", apellido1, " ", apellido2)) LIKE ?', ['%'.strtolower($this->serchGeneral).'%']) // Combinación completa: nombre1 + apellidos
                  ->orWhereRaw('LOWER(CONCAT(nombre1, " ", nombre2, " ", apellido1, " ", apellido2)) LIKE ?', ['%'.strtolower($this->serchGeneral).'%']) // Combinación completa con nombre2
                  ->orWhere('edad','like','%'.$this->serchGeneral.'%');
                });
        })
        ->when($this->primeraEdad != null && $this->segundaEdad != null, function ($query) {
            $query->whereBetween('edad', [$this->primeraEdad, $this->segundaEdad]);
        })
        ->when($this->primeraEdad != null && $this->segundaEdad == null, function ($query) {
            $query->where('edad', '>=', $this->primeraEdad);
        })
        ->when($this->segundaEdad != null && $this->primeraEdad == null, function ($query) {
            $query->where('edad', '<=', $this->segundaEdad);
        })
        ->paginate(9);

        return view('livewire.create-detalle-actividad-component', compact('expedientes','ids'));
    }

    public function detalle_actividad_store($id_expediente) {
        $hay_cupos = $this->cantidad_invitados();
        $expedienteActivo = $this->activo($id_expediente);
        
        if ($hay_cupos) {
            if (!$expedienteActivo) {
                // Crear el registro en la base de datos
                DetalleActividad::create([
                    'id_actividad' => $this->actividadId,
                    'id_expediente' => $id_expediente,
                    'asistencia' => 'Si',
                    'id_semaforo' => 1,
                ]);
            }else{
                DetalleActividad::where('id_actividad',$this->actividadId)
                ->where('id_expediente',$id_expediente)->delete();
            }
        }else{
            return redirect('actividades/detalles_actividades'.'/'.$this->actividadId);
        }
    }
}
