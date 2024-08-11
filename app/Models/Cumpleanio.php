<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cumpleanio extends Model
{
    use HasFactory;

    protected $table = 'cumpleanios';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'id_padrino',
        'fecha',
        'fecha_entrega_carta',
        'entrega_carta_presentacion',
        'entrega_regalo',
        'observaciones',
        'regalo',
    ];

    function padrinos(){
        return $this->belongsTo(Padrino::class,'id_padrino');
    }
}
