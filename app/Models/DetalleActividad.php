<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleActividad extends Model
{
    use HasFactory;

    protected $table = 'detalle_actividads';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'id_actividad',
        'id_expediente',
        'asistencia',
        'observacion',
        'id_semaforo',
    ];

    function actividades(){
        return $this->belongsTo(Actividad::class, 'id_actividad');
    }

    function expedientes(){
        return $this->belongsTo(Expediente::class, 'id_expediente');
    }

    function semaforos(){
        return $this->belongsTo(Semaforo::class, 'id_semaforo');
    }
}
