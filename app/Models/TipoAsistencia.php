<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAsistencia extends Model
{
    use HasFactory;

    protected $table = 'tipo_asistencias';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'tipo_asistencia',
    ];
}
