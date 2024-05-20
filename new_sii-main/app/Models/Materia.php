<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    public $timestamps = false;
     
    protected $table = 'materias';
    protected $fillable = [
        'calve_materia',
        'nombre',
        'creditos',
    ];

    public function planesEstudio () {
        return $this->belongsToMany(PlanEstudio::class);
    }

    public function grupos(){
        return $this->hasMany(Grupo::class);
    }
}
