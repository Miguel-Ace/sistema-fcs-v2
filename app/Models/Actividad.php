<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividads';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'actividad',
        'fecha_creacion',
        'fecha_actividad',
        'id_tipo_asistencia',
        'patrocinador',
        'id_proyecto',
        'cantidad_total_invitados',
        'cantidad_asistidos',
        'cantidad_ausentes',
        'observacion',
    ];

    function tipo_asistencias(){
        return $this->belongsTo(TipoAsistencia::class, 'id_tipo_asistencia');
    }

    function proyectos(){
        return $this->belongsTo(Proyecto::class, 'id_proyecto');
    }
}
