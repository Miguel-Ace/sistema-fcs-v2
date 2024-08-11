<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    use HasFactory;

    protected $table = 'enfermedads';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'id_evaluacion_medica',
        'id_expediente',
        'enfermedad',
        'medicamento',
    ];

    function evaluacion_medicas(){
        return $this->belongsTo(EvaluacionesMedica::class,'id_evaluacion_medica');
    }

    function expedientes(){
        return $this->belongsTo(Expediente::class,'id_expediente');
    }
}
