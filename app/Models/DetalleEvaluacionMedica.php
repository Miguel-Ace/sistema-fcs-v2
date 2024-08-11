<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleEvaluacionMedica extends Model
{
    use HasFactory;

    protected $table = 'detalle_evaluacion_medicas';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'id_evaluacion_medica',
        'id_especialidad',
        'medico',
        'diagnostico',
        'observacion',
        'id_semaforo',
        'nombre_diente',
        'descripcion',
        'fecha',
    ];

    function evaluacion_medicas(){
        return $this->belongsTo(EvaluacionesMedica::class,'id_evaluacion_medica');
    }
    function especialidades(){
        return $this->belongsTo(Especialidad::class, 'id_especialidad');
    }
    function semaforos(){
        return $this->belongsTo(Semaforo::class, 'id_semaforo');
    }
}
