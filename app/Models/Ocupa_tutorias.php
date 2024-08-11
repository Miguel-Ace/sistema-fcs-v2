<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ocupa_tutorias extends Model
{
    use HasFactory;
    protected $table = 'ocupa_tutorias';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'ocupa_tutoria',
    ];
}