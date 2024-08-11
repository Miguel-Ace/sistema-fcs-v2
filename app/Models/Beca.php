<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beca extends Model
{
    use HasFactory;

    protected $table = 'becas';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'beca',
    ];
}
