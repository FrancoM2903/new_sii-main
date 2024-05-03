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
}
