<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\User;
/* use App\Models\User;
use App\Models\User;
use App\Models\User; */

class AlumnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAlumno (){
        return view('escolares.alumno');
    }

    public function altaAlumno (){
        return view('escolares.altaAlumno');
    }

    public function crearAlumno (){
        return 'En la BD se da de alta';
    }


}
