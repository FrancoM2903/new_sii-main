<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'alumnos';

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
}
