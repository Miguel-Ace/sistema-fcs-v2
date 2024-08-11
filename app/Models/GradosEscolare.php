<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradosEscolare extends Model
{
    use HasFactory;

    protected $table = 'grados_escolares';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'grado_escolar',
    ];
}
