<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutoria extends Model
{
    use HasFactory;

    protected $table = 'tutorias';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'id_tutor',
        'id_expediente',
        'id_comunidad',
        'promedio',
        'nota',
        'id_semaforo',
    ];

    function tutores(){
        return $this->belongsTo(Tutor::class, 'id_tutor');
    }

    function expedientes(){
        return $this->belongsTo(Expediente::class, 'id_expediente');
    }

    function comunidades(){
        return $this->belongsTo(Comunidad::class, 'id_comunidad');
    }

    function semaforos(){
        return $this->belongsTo(Semaforo::class, 'id_semaforo');
    }
    
    // function notas(){
    //     return $this->belongsTo(Nota::class, 'id_notas');
    // }

}
