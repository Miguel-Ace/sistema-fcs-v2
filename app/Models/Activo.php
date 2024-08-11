<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    use HasFactory;
    protected $table = 'activos';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'activo',
    ];
}
