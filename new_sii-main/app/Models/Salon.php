<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    protected $table = 'salones';
    
    // Indicar a Laravel que no maneje las marcas de tiempo
    public $timestamps = false;

    public function edificio() {
        return $this->belongsTo(Edificio::class);
    }

    protected $fillable = [
        'nombre_edificio',
        'descripcion',
    ];

    //use HasFactory;
}
