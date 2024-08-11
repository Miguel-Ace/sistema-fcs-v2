<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntregasMensuale extends Model
{
    use HasFactory;

    protected $table = 'entregas_mensuales';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'id_expediente',
        'id_padrino',
        'id_insumos',
        'fecha',
        'observaciones',
    ];

    function expedientes(){
        return $this->belongsTo(Expediente::class, 'id_expediente');
    }
    
    function padrinos(){
        return $this->belongsTo(Padrino::class, 'id_padrino');
    }

    function insumos(){
        return $this->belongsTo(Insumo::class, 'id_insumos');
    }
}
