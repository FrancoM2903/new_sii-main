<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use App\Models\Grupo;
use App\Models\Periodo;
use App\Models\PlanEstudio;
use App\Models\Materia;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class GrupoController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getGrupo($id) {
        $planEstudio = PlanEstudio::find($id);
        $grupos = Grupo::all();
        //$grupos = Grupo::with('periodos')->get();
        $periodos = Periodo::all();
        $materias = Materia::all();
        $docentes = Docente::all();
        return view('escolares.grupo', compact('grupos', 'planEstudio','periodos','materias','docentes'));
    }

    public function createGrupo(Request $request, $idPlan) {
        try {
            $request->validate([
                'selectPeriGrupo' => 'required',
                'selectMatGrup' => 'required',
                'txtSemGrupo' => 'required',
                'txtLetraGrupo' => 'required',
                'txtCapGrupo' => 'required',
                'selectDocenGrup' => 'required',
            ]);

            // Crea un nuevo plan
            $planEstudio = PlanEstudio::findOrFail($idPlan);

            $grupo = new Grupo();

            $grupo->periodo_id = $request->selectPeriGrupo;
            $grupo->plan_estudio_id = $idPlan;
            $grupo->materia_id = $request->selectMatGrup;
            $grupo->semestre = $request->txtSemGrupo;
            $grupo->letra_grupo = $request->txtLetraGrupo;
            $grupo->capacidad = $request->txtCapGrupo;
            $grupo->docente_id = $request->selectDocenGrup;

            $planEstudio->grupos()->save($grupo);

            return back()->with("Correcto", "Materia creada correctamente");

        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Esa materia ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error desconocido: " . $e->getMessage() . " (Código: " . $e->errorInfo[1] . ")");

        }
    }

    public function updateGrupo(Request $request, $idPlan, $idGrupo) {

        try {
            // Validar los datos
            $request->validate([
                'selectPeriGrupoUp' => 'required',
                'selectMatGrupUp' => 'required',
                'txtSemGrupoUp' => 'required',
                'txtLetraGrupoUp' => 'required',
                'txtCapGrupoUp' => 'required',
                'selectDocenGrupUp' => 'required',
            ]);

            $planEstudio = PlanEstudio::findOrFail($idPlan);
            $grupo = $planEstudio->grupos()->findOrFail($idGrupo);

            $grupo->periodo_id = $request->selectPeriGrupoUp;
            $grupo->materia_id = $request->selectMatGrupUp;
            $grupo->semestre = $request->txtSemGrupoUp;
            $grupo->letra_grupo = $request->txtLetraGrupoUp;
            $grupo->capacidad = $request->txtCapGrupoUp;
            $grupo->docente_id = $request->selectDocenGrupUp;
            $grupo->save();

            return back()->with("Correcto", "Grupo modificado correctamente");
        } catch (QueryException $e) {
            // Verificar si el error es debido a una restricción de unicidad
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "Error, el grupo ya existe");
            }
            // Si no es una restricción de unicidad, puedes manejar otros tipos de errores aquí
            return back()->with("Incorrecto", "Error desconocido: " . $e->getMessage() . " (Código: " . $e->errorInfo[1] . ")");
        }
    }

    public function deleteGrupo($idPlan, $idGrupo) {
        //Hay que recibir como parametro el id del registro a eliminar
        try {
            // Buscamos el plan de estudio
            $planEstudio = PlanEstudio::findOrFail($idPlan);
            $grupo = $planEstudio->grupos()->findOrFail($idGrupo);
            // Se elimina
            $grupo->delete();

            return back()->with("Correcto", "Se ha eliminado la materia correctamente");
        } catch (QueryException $e) {
            // Cualquier  error
            return back()->with("Incorrecto", "Error al eliminar la materia");
        }
    }
}
