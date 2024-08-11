<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionesMedica extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones_medicas';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'id_expediente',
        'id_clinica',
        'fecha',
        'peso',
        'talla',
        'signos',
        'notas',
    ];

    function expedientes(){
        return $this->belongsTo(Expediente::class, 'id_expediente');
    }
    
    function clinicas(){
        return $this->belongsTo(Clinica::class, 'id_clinica');
    }
}
