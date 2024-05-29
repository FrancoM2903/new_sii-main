<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoGrupo extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'alumno_grupo';

    protected $fillable = [
        'alumno_id',
        'grupo_id',
    ];
}
