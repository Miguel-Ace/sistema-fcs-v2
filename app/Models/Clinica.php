<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinica extends Model
{
    use HasFactory;

    protected $table = 'clinicas';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'clinica',
    ];
}
