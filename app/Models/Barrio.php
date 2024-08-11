<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    use HasFactory;

    protected $table = 'barrios';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'barrio',
        'id_canton',
    ];

    function cantones(){
        return $this->belongsTo(Cantone::class,'id_canton');
    }
}
