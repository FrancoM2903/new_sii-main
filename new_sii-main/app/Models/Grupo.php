<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model {

    use HasFactory;

    protected $table = 'grupos';

    public $timestamps = false;

    protected $fillable = [
        'periodo_id',
        'plan_estudio_id',
        'materia_id',
        'semestre',
        'letra_grupo',
        'capacidad',
        'docente_id',
    ];

    public function periodo(){
        return $this->belongsTo(Periodo::class);
    }

    public function planEstudio(){
        return $this->belongsTo(PlanEstudio::class);
    }

    public function materia(){
        return $this->belongsTo(Materia::class);
    }

    public function docente(){
        return $this->belongsTo(Docente::class);
    }

    public function alumno() {
        return $this->belongsToMany(Alumno::class);
    }

}