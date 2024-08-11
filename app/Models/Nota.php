<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $table = 'notas';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'id_expediente',
        'promedio',
        'fecha',
        'id_grado_escolar',
        'id_ocupa_tutoria',
        'tipo_promedio',
        'id_semaforo',
        'observaciones',
    ];

    function expedientes(){
        return $this->belongsTo(Expediente::class, 'id_expediente');
    }
    function grados_escolares(){
        return $this->belongsTo(GradosEscolare::class, 'id_grado_escolar');
    }
    function ocupa_tutorias(){
        return $this->belongsTo(Ocupa_tutorias::class, 'id_ocupa_tutoria');
    }
    function semaforos(){
        return $this->belongsTo(Semaforo::class, 'id_semaforo');
    }
}
