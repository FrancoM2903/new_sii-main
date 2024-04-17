<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index (){
        return view('escolares.alumno');
    }

    public function altaAlumno (){
        return view('escolares.altaAlumno');
    }

    public function crearAlumno (){
        return 'En la BD se da de alta';
    }


}
