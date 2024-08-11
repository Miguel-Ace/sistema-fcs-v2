<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPobreza extends Model
{
    use HasFactory;

    protected $table = 'tipo_pobrezas';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'tipo_pobreza',
    ];
}
