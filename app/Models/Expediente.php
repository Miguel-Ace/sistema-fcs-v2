<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;

    protected $table = 'expedientes';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'id_comunidad',
        'codigo_nino',
        'nombre1',
        'nombre2',
        'apellido1',
        'apellido2',
        'pp',
        'id_estado',
        'id_sexo',
        'cedula',
        'id_tipo_pobreza',
        'id_barrio',
        'fecha_nacimiento',
        'contacto_representante',
        'id_grado_escolar',
        'talla_pantalon',
        'talla_camisa',
        'talla_zapato',
        'id_activo',
        'nombre_encargado',
        'telefono_encargado',
        'id_centro_educativo',
        'id_padrino',
        'id_beca',
    ];

    function becas(){
        return $this->belongsTo(Beca::class, 'id_beca');
    }
    function activos(){
        return $this->belongsTo(Activo::class, 'id_activo');
    }
    function sexos(){
        return $this->belongsTo(Sexo::class, 'id_sexo');
    }
    function comunidades(){
        return $this->belongsTo(Comunidad::class, 'id_comunidad');
    }
    function estados(){
        return $this->belongsTo(Estado::class, 'id_estado');
    }
    function tipo_pobrezas(){
        return $this->belongsTo(TipoPobreza::class, 'id_tipo_pobreza');
    }
    function barrios(){
        return $this->belongsTo(Barrio::class, 'id_barrio');
    }
    function grados_escolares(){
        return $this->belongsTo(GradosEscolare::class, 'id_grado_escolar');
    }
    function centro_educativos(){
        return $this->belongsTo(CentroEducativo::class, 'id_centro_educativo');
    }
    function padrinos(){
        return $this->belongsTo(Padrino::class, 'id_padrino');
    }
}
