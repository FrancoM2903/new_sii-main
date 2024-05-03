<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Especialidad;

class EspecialidadController extends Controller {

    // CONTROLADOR
    public function __construct() {
        $this->middleware('auth');
    }

    // CREACION DE SALONES
    public function createEspecialidad(Request $request) {
        try {
            $request->validate([
                'txtClaveEsp' => 'required',
                'txtEspecialidad' => 'required',
                'selectPlanEsp' => 'required',
            ]);

            // Crea un nuevo plan
            $especialidad = new Especialidad();
            $especialidad->clave_especialidad = $request->txtClaveEsp;
            $especialidad->especilidad = $request->txtEspecialidad;
            $especialidad->plan_estudio_id = $request->selectPlanEsp;
            $especialidad->save();

            return back()->with("Correcto", "¡Especialidad creada correctamente!");
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Esa especialidad ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar la especialidad");
        }
    }

    public function updateEspecialidad(Request $request, $id) {
        try {

            $especialidad = Especialidad::findOrFail($id);
            $especialidad->clave_especialidad = $request->txtClaveEsp_Up;
            $especialidad->especilidad = $request->txtEspecialidad_Up;
            $especialidad->plan_estudio_id = $request->selectPlanEsp_Up;
            $especialidad->save();
            return back()->with("Correcto", "Especialidad modificada correctamente");
        } catch (QueryException $e) {
            // Verificar si el error es debido a una restricción de unicidad
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "Error, la especialidad ya existe");
            }

            // Si no es una restricción de unicidad, puedes manejar otros tipos de errores aquí
            return back()->with("Incorrecto", "Erroral agregar la especialidad");
        }
    }

    public function deleteEspecialidad($id) {
        //Hay que recibir como parametro el id del registro a eliminar
        try {
            // Buscamos el plan de estudio
            $especialidad = Especialidad::findOrFail($id);
            // Se elimina
            $especialidad->delete();

            return back()->with("Correcto", "Se ha eliminado la especialidad correctamente");
        } catch (QueryException $e) {
            // Cualquier  error
            return back()->with("Incorrecto", "Error al eliminar la especialidad");
        }
    } 

}
