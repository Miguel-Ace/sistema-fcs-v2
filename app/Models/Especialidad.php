<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $table = 'especialidads';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'especialidad',
    ];
}
