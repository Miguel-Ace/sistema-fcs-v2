<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEntrega extends Model
{
    use HasFactory;

    protected $table = 'tipo_entregas';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'tipo_entrega',
    ];
}
