<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPlanEstudio extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'materia_plan_estudio';

    protected $fillable = [
        'materia_id',
        'plan_estudio_id',
    ];
}
