<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semaforo extends Model
{
    use HasFactory;

    protected $table = 'semaforos';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'semaforo',
    ];
}
