<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Alumno;
use App\Models\AlumnoGrupo;


class AlumnoGrupoController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function getAlumnoGrupo($id) {
        $grupo = Grupo::find($id);
        $alumno = Alumno::all();
        return view('divEstudio.alumno-grupo', compact('grupo', 'alumno'));
    }

    public function createAlumnoGrupo(Request $request, $idGrupo) {
        try {
            
            $grupo = Grupo::find($idGrupo);
            $grupo->alumno()->attach($request->selectAlumGru);
            
            return back()->with("Correcto", "Materia agregada correctamente");
        
        } catch (QueryException $e) {
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar la materia ".$e);
        }
    }

    public function deleteAlumnoGrupo($idGrupo, $idAlumno) {
        try {
            
            $grupo = Grupo::find($idGrupo);
            $grupo->alumno()->detach($idAlumno);

            return back()->with("Correcto", "Se ha eliminado la materia correctamente");
        } catch (QueryException $e) {
            // Cualquier  error
            return back()->with("Incorrecto", "Error al eliminar la materia");
        }
    } 

    public function getDocenteAlumnoGrupo($id){
        #return $planes->materias;
        $alumnos = Alumno::all();
        $alumnosGrupos = AlumnoGrupo::all();
        $grupos = Grupo::find($id);
        return view('docente.lista-alumno-docente', compact('alumnosGrupos','alumnos', 'grupos'));
    }
}