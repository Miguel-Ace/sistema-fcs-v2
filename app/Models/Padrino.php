<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Padrino extends Model
{
    use HasFactory;

    protected $table = 'padrinos';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'nombre',
        'apellido',
        'telefono',
        'direccion',
        'correo',
        'tipo',
        'fecha_inicio',
        'fecha_final',
        'fecha_nacimiento',
        'id_provincia',
        'id_canton',
        'id_barrio',
        'id_metodo_pago',
        'id_banco',
    ];

    function provincias(){
        return $this->belongsTo(Provincia::class, 'id_provincia');
    }
    
    function cantones(){
        return $this->belongsTo(Cantone::class, 'id_canton');
    }

    function barrios(){
        return $this->belongsTo(Barrio::class, 'id_barrio');
    }

    function metodos_pagos(){
        return $this->belongsTo(MetodosPago::class, 'id_metodo_pago');
    }
    
    function bancos(){
        return $this->belongsTo(Banco::class, 'id_banco');
    }
}
