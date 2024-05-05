<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estatus extends Model
{
    use HasFactory;

    public $timestamps = false;
     
    protected $table = 'estatus';

    public function alumno(){
        return $this->hasOne(Alumno::class);
    }
}
