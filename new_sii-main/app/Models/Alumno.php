<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'alumnos';

    protected $fillable = [
        'numero_control',
        'nombre',
        'ap_paterno',
        'ap_materno',
        'curp',
        'semestre',
        'plan_estudio_id',
        'user_id',
        'estatus_id',
        'tipo_alumno_id',
    ];

    public function planEstudio() {
        return $this->belongsTo(PlanEstudio::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function estatus(){
        return $this->belongsTo(Estatus::class);
    }

    public function tipoAlumno(){
        return $this->belongsTo(TiposAlumno::class);
    }

    public function grupo() {
        return $this->belongsToMany(Grupo::class);
    }
}
