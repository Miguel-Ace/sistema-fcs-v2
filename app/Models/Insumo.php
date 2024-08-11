<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;

    protected $table = 'insumos';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'insumo',
    ];
}
