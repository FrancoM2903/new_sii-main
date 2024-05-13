<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MateriaPlanEstudio;
use App\Models\Materia;
use App\Models\PlanEstudio;

class MateriaPlanEstudioController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getMateriasPlan($id) {
        $planEstudio = PlanEstudio::find($id);
        //return $planEstudio;
        //return $planEstudio->materias;
        $materias = Materia::all();
        return view('escolares.materia-plan-estudio', compact('materias', 'planEstudio'));
    }

    public function createMateriaPlanEstudio(Request $request, $idPlan) {
        try {
            
            $planEstudio = PlanEstudio::find($idPlan);
            $planEstudio->materias()->attach($request->selectMatPlan);
            
            return back()->with("Correcto", "Materia agregada correctamente");
        
        } catch (QueryException $e) {
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar la materia ".$e);
        }
    }

    public function deleteMateriaPlanEstudio($idPlan, $idMateria) {
        try {
            
            $planEstudio = PlanEstudio::find($idPlan);
            $planEstudio->materias()->detach($idMateria);

            return back()->with("Correcto", "Se ha eliminado la materia correctamente");
        } catch (QueryException $e) {
            // Cualquier  error
            return back()->with("Incorrecto", "Error al eliminar la materia");
        }
    }
}
