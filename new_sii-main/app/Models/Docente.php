<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
     // Indicar a Laravel que no maneje las marcas de tiempo
    public $timestamps = false;
     
    protected $table = 'docentes';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
