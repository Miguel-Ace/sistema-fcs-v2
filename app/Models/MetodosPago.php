<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodosPago extends Model
{
    use HasFactory;

    protected $table = 'metodos_pagos';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'metodo_pago',
    ];
}
