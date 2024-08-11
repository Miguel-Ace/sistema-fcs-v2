<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentroEducativo extends Model
{
    use HasFactory;

    protected $table = 'centro_educativos';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'centro_educativo',
    ];

}
