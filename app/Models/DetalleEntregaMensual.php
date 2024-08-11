<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleEntregaMensual extends Model
{
    use HasFactory;

    protected $table = 'detalle_entregas_mensuales';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'id_entrega_mensual',
        'id_expediente',
        'id_tipoEntrega',
    ];
    
    function entregas_mensuales(){
        return $this->belongsTo(DetalleEntregaMensual::class, 'id_entrega_mensual');
    }

    function expedientes(){
        return $this->belongsTo(Expediente::class, 'id_expediente');
    }

    function tipoEntregas(){
        return $this->belongsTo(TipoEntrega::class, 'id_tipoEntrega');
    }
}
