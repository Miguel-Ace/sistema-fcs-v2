<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotivoBaja extends Model
{
    use HasFactory;

    protected $table = 'motivo_bajas';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'motivo_baja',
    ];
}
