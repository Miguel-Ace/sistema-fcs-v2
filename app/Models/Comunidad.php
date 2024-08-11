<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
    use HasFactory;

    protected $table = 'comunidads';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'comunidad',
    ];
}
