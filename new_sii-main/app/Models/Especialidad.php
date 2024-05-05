<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;
    protected $table = 'especialidades';
    
    // Indicar a Laravel que no maneje las marcas de tiempo
    public $timestamps = false;

    public function planEstudio() {
        return $this->belongsTo(PlanEstudio::class);
    }

    protected $fillable = [
        'clave_especialidad',
        'especilidad',
        'plan_estudio_id',
    ];
}
