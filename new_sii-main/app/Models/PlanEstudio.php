<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanEstudio extends Model
{
    protected $table = 'planes_estudio';

    public $timestamps = false;

    protected $fillable = [
        'clave_plan_estudio',
        'carrera',
    ];

    
    public function especialidades() {
        return $this -> hasMany(Especialidad::class);
    }

    public function alumnos() {
        return $this -> hasMany(Alumno::class);
    }

    public function materias() {
        return $this->belongsToMany(Materia::class);
    }

    public function grupos(){
        return $this->hasMany(Grupo::class);
    }
}
