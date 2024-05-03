<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlanEstudio;
use App\Models\Especialidad;

use Illuminate\Database\QueryException;

class PlanEstudioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $planes = PlanEstudio::all();
        $especialidades = Especialidad::all();
        return view('escolares.planes-estudio', compact('planes','especialidades'));
    }

    public function updatePlanEstudio(Request $request, $id)
    {
        //$data = $request->all();
        //return $request;
        try {
            // Tu lógica para actualizar el plan de estudios aquí
            $plan = PlanEstudio::findOrFail($id);
            //$plan =  select * from planes_estudio where id = $id
            $plan->clave_plan_estudio = $request->txtClave;
            $plan->carrera = $request->txtCarrera;
            // Actualiza otros campos si es necesario...
            $plan->save();
            return back()->with("Correcto", "Plan de estudio modificado correctamente");
        } catch (QueryException $e) {
            // Verificar si el error es debido a una restricción de unicidad
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "Error, la clave del plan ya existe");
            }

            // Si no es una restricción de unicidad, puedes manejar otros tipos de errores aquí
            return back()->with("Incorrecto", "Error desconocido");
        }
    }

    public function createPlanEstudio(Request $request)
    {
        try {
            $request->validate([
                'txtClave' => 'required|string',
                'txtCarrera' => 'required|string',
                // Agrega más reglas de validación para otros campos aquí
                // los 'txt' vienen de la vista
            ]);

            // Crea un nuevo plan
            $plan = new PlanEstudio();
            $plan->clave_plan_estudio = $request->txtClave;
            $plan->carrera = $request->txtCarrera;

            $plan->save(); //Guardamos

            return back()->with("Correcto", "Plan de estudio agregado correctamente");
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Esa clave de plan de estudios ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar el plan de estudios");
        }
    }

    public function deletePlanEstudio($id)
    {
        //Hay que recibir como parametro el id del registro a eliminar
        try {
            // Buscamos el plan de estudio
            $planEstudio = PlanEstudio::findOrFail($id);
            // Se elimina
            $planEstudio->delete();

            return back()->with("Correcto", "Se ha eliminado el plan de estudio correctamente");
        } catch (QueryException $e) {
            // Cualquier  error
            return back()->with("Incorrecto", "Error al eliminar el plan de estudios");
        }
    }
}
