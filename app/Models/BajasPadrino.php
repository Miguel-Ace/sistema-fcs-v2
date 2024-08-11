<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BajasPadrino extends Model
{
    use HasFactory;

    protected $table = 'bajas_padrinos';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'id_padrino',
        'id_expediente',
        'fecha_baja',
        'detalle_salida',
        'id_motivo_baja',
    ];

    function padrinos(){
        return $this->belongsTo(Padrino::class,'id_padrino');
    }
    function expedientes(){
        return $this->belongsTo(Expediente::class, 'id_expediente');
    }
    function motivo_bajas(){
        return $this->belongsTo(MotivoBaja::class, 'id_motivo_baja');
    }
}
